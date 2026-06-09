<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecapitulationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $participations = Participation::with(['competition.category', 'competition.field'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Statistik umum
        $stats = [
            'total' => $participations->count(),
            'win' => $participations->whereIn('result', ['juara_1', 'juara_2', 'juara_3'])->count(),
            'submitted' => $participations->where('status', 'submitted')->count(),
            'completed' => $participations->where('status', 'completed')->count(),
        ];

        // Per kategori
        $byCategory = $participations->groupBy('competition.category.name')
            ->map(fn($g) => $g->count())
            ->sortDesc();

        // Per bulan (12 bulan terakhir)
        $byMonth = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $byMonth[$month->format('M Y')] = $participations
                ->filter(fn($p) => $p->created_at->format('Y-m') === $month->format('Y-m'))
                ->count();
        }

        // Per level
        $byLevel = $participations->groupBy('competition.level')
            ->map(fn($g) => $g->count());

        // Hasil terbaik
        $bestResults = $participations
            ->whereIn('result', ['juara_1', 'juara_2', 'juara_3', 'juara_harapan', 'terpilih', 'favorit'])
            ->values();

        return view('student.recapitulation', compact(
            'participations',
            'stats',
            'byCategory',
            'byMonth',
            'byLevel',
            'bestResults'
        ));
    }

    // AI Summarize
    public function summarize(Request $request)
    {
        $user = auth()->user();
        $participations = Participation::with(['competition'])
            ->where('user_id', $user->id)->get();

        $dataText = $participations->map(
            fn($p) =>
            "- {$p->competition->title} ({$p->competition->level}): {$p->status}, hasil: {$p->result}"
        )->join("\n");

        $apiKey = \App\Models\AppSetting::get('claude_api_key');

        if (!$apiKey) {
            return response()->json([
                'summary' =>
                    "Kamu sudah mengikuti {$participations->count()} lomba. Terus semangat dan tingkatkan prestasimu!"
            ]);
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'Content-Type' => 'application/json',
            ])->post('https://api.anthropic.com/v1/messages', [
                        'model' => 'claude-haiku-4-5-20251001',
                        'max_tokens' => 400,
                        'messages' => [
                            [
                                'role' => 'user',
                                'content' => "Kamu adalah asisten motivasi untuk siswa SMK. Berikan rangkuman progres dan motivasi untuk siswa bernama {$user->name} berdasarkan data lomba berikut:\n\n{$dataText}\n\nBuat rangkuman 3-4 kalimat yang memotivasi, dengan menyebutkan pencapaian utama dan saran pengembangan. Bahasa Indonesia, santai tapi memotivasi.",
                            ]
                        ],
                    ]);

            if ($response->successful()) {
                return response()->json([
                    'summary' => $response->json('content.0.text') ?? 'Terus semangat!'
                ]);
            }
        } catch (\Exception $e) {
        }

        return response()->json(['summary' => "Kamu sudah mengikuti {$participations->count()} lomba. Terus semangat!"]);
    }
}