<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Competition;
use App\Models\Participation;
use App\Models\Mentorship;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = User::where('role', 'student')->count();
        $totalGuru = User::where('role', 'teacher')->count();
        $totalLomba = Competition::count();
        $lombaAktif = Competition::where('is_active', true)
            ->whereDate('deadline', '>=', now())->count();
        $totalPart = Participation::count();
        $totalJuara = Participation::whereIn('result', ['juara_1', 'juara_2', 'juara_3'])->count();
        $pendingMentor = Mentorship::where('status', 'pending')->count();

        // Lomba trending
        $trendingComps = Competition::with('category')
            ->where('is_active', true)
            ->whereDate('deadline', '>=', now())
            ->orderByDesc('view_count')
            ->take(5)->get();

        // Siswa terbaru
        $recentStudents = User::where('role', 'student')
            ->with('studentProfile')
            ->latest()->take(5)->get();

        // Partisipasi terbaru
        $recentPart = Participation::with(['user', 'competition'])
            ->latest()->take(5)->get();

        // Statistik lomba per level (untuk chart)
        $levelStats = Competition::selectRaw('level, count(*) as total')
            ->groupBy('level')->pluck('total', 'level');

        // Statistik partisipasi per bulan (6 bulan terakhir)
        $monthlyPart = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyPart[] = [
                'label' => $month->format('M Y'),
                'count' => Participation::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)->count(),
            ];
        }

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalLomba',
            'lombaAktif',
            'totalPart',
            'totalJuara',
            'pendingMentor',
            'trendingComps',
            'recentStudents',
            'recentPart',
            'levelStats',
            'monthlyPart'
        ));
    }
}