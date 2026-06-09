<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Participation;
use App\Models\ParticipationStep;
use App\Models\Mentorship;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    // Daftar semua lomba yang diikuti
    public function index()
    {
        $participations = Participation::with(['competition.category', 'competition.stages', 'steps', 'team', 'mentorship.teacher'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('student.participations', compact('participations'));
    }

    // Detail satu partisipasi
    public function show(Participation $participation)
    {
        abort_if($participation->user_id !== auth()->id(), 403);

        $participation->load([
            'competition.category',
            'competition.stages',
            'competition.field',
            'steps',
            'team.members.user',
            'mentorship.teacher.teacherProfile',
        ]);

        $teachers = User::where('role', 'teacher')
            ->with('teacherProfile')
            ->get();

        return view('student.participation-detail', compact('participation', 'teachers'));
    }

    // Join lomba
    public function join(Request $request)
    {
        $request->validate(['competition_id' => 'required|exists:competitions,id']);

        $competition = Competition::findOrFail($request->competition_id);

        // Cek sudah ikut belum
        $existing = Participation::where('user_id', auth()->id())
            ->where('competition_id', $competition->id)
            ->first();

        if ($existing) {
            return redirect()->route('student.participations.show', $existing->id)
                ->with('error', 'Kamu sudah terdaftar di lomba ini.');
        }

        if ($competition->type === 'team') {
            return redirect()->route('student.teams.create', ['competition_id' => $competition->id]);
        }

        $participation = Participation::create([
            'user_id' => auth()->id(),
            'competition_id' => $competition->id,
            'status' => 'registered',
            'result' => 'belum_diisi',
            'current_stage' => 1,
        ]);

        // Buat steps otomatis
        $this->createSteps($participation, $competition);

        return redirect()->route('student.participations.show', $participation->id)
            ->with('success', 'Berhasil mendaftar lomba! Semangat ya!');
    }

    // Konfirmasi step
    public function confirmStep(Request $request, Participation $participation)
    {
        abort_if($participation->user_id !== auth()->id(), 403);

        $request->validate([
            'step_order' => 'required|integer',
            'notes' => 'nullable|string|max:500',
        ]);

        $step = ParticipationStep::where('participation_id', $participation->id)
            ->where('step_order', $request->step_order)
            ->firstOrFail();

        $step->update([
            'is_confirmed' => true,
            'confirmed_at' => now(),
            'notes' => $request->notes,
        ]);

        // Update status partisipasi
        $stepMap = [
            1 => 'registered',
            2 => 'in_progress',
            3 => 'submitted',
            4 => 'completed',
        ];
        if (isset($stepMap[$request->step_order])) {
            $participation->update(['status' => $stepMap[$request->step_order]]);
        }

        return response()->json(['ok' => true, 'message' => 'Step dikonfirmasi!']);
    }

    // Submit hasil akhir
    public function submitResult(Request $request, Participation $participation)
    {
        abort_if($participation->user_id !== auth()->id(), 403);

        $request->validate([
            'result' => 'required|in:juara_1,juara_2,juara_3,juara_harapan,favorit,terpilih,lolos_tahap,tidak_lolos',
            'current_stage' => 'nullable|integer',
            'notes' => 'nullable|string|max:1000',
        ]);

        $participation->update([
            'result' => $request->result,
            'status' => 'completed',
            'current_stage' => $request->current_stage ?? $participation->current_stage,
            'notes' => $request->notes,
        ]);

        // Notif ke guru jika ada mentor
        if ($participation->mentorship && $participation->mentorship->status === 'accepted') {
            Notification::create([
                'user_id' => $participation->mentorship->teacher_id,
                'type' => 'result_submitted',
                'title' => 'Siswa Mengisi Hasil Lomba',
                'body' => auth()->user()->name . ' telah mengisi hasil lomba "' . $participation->competition->title . '".',
                'icon' => 'fa-medal',
                'color' => '#f5a623',
                'data' => ['participation_id' => $participation->id],
            ]);
        }

        return redirect()->route('student.participations.show', $participation->id)
            ->with('success', 'Hasil lomba berhasil diisi!');
    }

    // Request guru pembimbing
    public function requestMentor(Request $request, Participation $participation)
    {
        abort_if($participation->user_id !== auth()->id(), 403);

        $request->validate(['teacher_id' => 'required|exists:users,id']);

        $teacher = User::where('id', $request->teacher_id)
            ->where('role', 'teacher')->firstOrFail();

        // Cek sudah ada mentor request belum
        $existing = Mentorship::where('participation_id', $participation->id)->first();
        if ($existing) {
            return response()->json(['error' => 'Sudah ada permintaan mentor untuk lomba ini.'], 422);
        }

        $mentorship = Mentorship::create([
            'participation_id' => $participation->id,
            'teacher_id' => $teacher->id,
            'status' => 'pending',
        ]);

        // Kirim notifikasi ke guru
        Notification::create([
            'user_id' => $teacher->id,
            'type' => 'mentorship_request',
            'title' => 'Permintaan Menjadi Pembimbing',
            'body' => auth()->user()->name . ' mengajukan kamu sebagai pembimbing lomba "' . $participation->competition->title . '".',
            'icon' => 'fa-chalkboard-teacher',
            'color' => '#e31e25',
            'data' => ['participation_id' => $participation->id, 'mentorship_id' => $mentorship->id],
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Permintaan pembimbing berhasil dikirim ke ' . $teacher->name,
            'wa' => $teacher->wa_number,
        ]);
    }

    // Helper: buat steps otomatis
    private function createSteps(Participation $participation, Competition $competition): void
    {
        $steps = [
            ['step_name' => 'Sudah Mendaftar', 'step_order' => 1],
            ['step_name' => 'Progres Pengerjaan', 'step_order' => 2],
            ['step_name' => 'Berhasil Submit', 'step_order' => 3],
            ['step_name' => 'Pengisian Hasil', 'step_order' => 4],
        ];

        foreach ($steps as $step) {
            ParticipationStep::create(array_merge(
                ['participation_id' => $participation->id, 'is_confirmed' => false],
                $step
            ));
        }
    }
}