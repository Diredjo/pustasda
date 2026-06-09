<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SettingsController extends Controller
{
    public function profile()
    {
        $user = auth()->user()->load('studentProfile');
        $profile = $user->studentProfile ?? new StudentProfile();
        return view('student.settings.profile', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'wa_number' => 'nullable|string|max:20',
            'nis' => 'nullable|string|max:20',
            'kelas' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:100',
            'angkatan' => 'nullable|integer',
            'photo' => 'nullable|image|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'wa_number' => $request->wa_number,
        ]);

        if ($request->hasFile('photo')) {
            $filename = 'avatar-' . $user->id . '.' . $request->photo->extension();
            $request->photo->move(public_path('images/avatars'), $filename);
            $user->update(['photo' => $filename]);
        }

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        StudentProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nis' => $request->nis,
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
                'angkatan' => $request->angkatan,
            ]
        );

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function quiz()
    {
        $user = auth()->user()->load('studentProfile');
        $profile = $user->studentProfile ?? new StudentProfile();
        return view('student.settings.quiz', compact('user', 'profile'));
    }

    public function processQuiz(Request $request)
    {
        $request->validate([
            'minat' => 'required|array|min:1',
            'keahlian' => 'required|array|min:1',
            'kepribadian' => 'required|string',
            'tujuan' => 'required|string|max:500',
            'pengalaman' => 'required|string',
        ]);

        $user = auth()->user();

        // Simpan preferences dulu
        $preferences = [
            'minat' => $request->minat,
            'keahlian' => $request->keahlian,
            'kepribadian' => $request->kepribadian,
            'tujuan' => $request->tujuan,
            'pengalaman' => $request->pengalaman,
        ];

        // Panggil Claude AI untuk generate bio
        $bio = $this->generateBioWithAI($preferences, $user->name);

        StudentProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'preferences' => $preferences,
                'bio_ai' => $bio,
            ]
        );

        return response()->json([
            'ok' => true,
            'bio' => $bio,
        ]);
    }

    public function privacy()
    {
        $profile = auth()->user()->studentProfile ?? new StudentProfile();
        return view('student.settings.privacy', compact('profile'));
    }

    public function updatePrivacy(Request $request)
    {
        StudentProfile::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'privacy_profile' => $request->privacy_profile ?? 'public',
                'allow_team_invite' => $request->boolean('allow_team_invite'),
            ]
        );
        return back()->with('success', 'Pengaturan privasi disimpan!');
    }

    public function notification()
    {
        $profile = auth()->user()->studentProfile ?? new StudentProfile();
        return view('student.settings.notification', compact('profile'));
    }

    public function updateNotification(Request $request)
    {
        StudentProfile::updateOrCreate(
            ['user_id' => auth()->id()],
            ['notification_pref' => $request->notification_pref ?? 'all']
        );
        return back()->with('success', 'Preferensi notifikasi disimpan!');
    }

    // Generate bio via Claude AI
    private function generateBioWithAI(array $data, string $name): string
    {
        $apiKey = \App\Models\AppSetting::get('claude_api_key');

        if (!$apiKey) {
            return $this->fallbackBio($data, $name);
        }

        try {
            $prompt = "Kamu adalah asisten untuk platform lomba siswa SMK. Buatkan deskripsi singkat diri siswa berdasarkan data berikut dalam 3-4 kalimat yang natural, personal, dan memotivasi. Gunakan bahasa Indonesia yang baik.

Nama: {$name}
Minat: " . implode(', ', $data['minat']) . "
Keahlian: " . implode(', ', $data['keahlian']) . "
Kepribadian: {$data['kepribadian']}
Tujuan: {$data['tujuan']}
Pengalaman lomba: {$data['pengalaman']}

Tulis deskripsi singkat dari sudut pandang orang ketiga (menyebut nama siswa). Fokus pada potensi, minat, dan semangat berprestasi. Maksimal 100 kata.";

            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'Content-Type' => 'application/json',
            ])->post('https://api.anthropic.com/v1/messages', [
                        'model' => 'claude-haiku-4-5-20251001',
                        'max_tokens' => 300,
                        'messages' => [
                            ['role' => 'user', 'content' => $prompt],
                        ],
                    ]);

            if ($response->successful()) {
                $content = $response->json('content');
                return $content[0]['text'] ?? $this->fallbackBio($data, $name);
            }
        } catch (\Exception $e) {
            // Log error tapi jangan crash
        }

        return $this->fallbackBio($data, $name);
    }

    private function fallbackBio(array $data, string $name): string
    {
        $minat = implode(', ', $data['minat'] ?? []);
        $keahlian = implode(', ', $data['keahlian'] ?? []);
        return "{$name} adalah siswa bersemangat dengan minat di bidang {$minat}. " .
            "Memiliki keahlian dalam {$keahlian} dan berkarakter {$data['kepribadian']}. " .
            "Bertujuan untuk {$data['tujuan']} dan terus mengembangkan diri melalui kompetisi.";
    }
}           