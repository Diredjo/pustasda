<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Participation;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $trending = Competition::with(['category', 'field'])
            ->where('is_trending', true)
            ->where('is_active', true)
            ->whereDate('deadline', '>=', now())
            ->take(4)->get();

        $terbaru = Competition::with(['category', 'field'])
            ->where('is_active', true)
            ->whereDate('deadline', '>=', now())
            ->latest()->take(4)->get();

        $nasional = Competition::with(['category', 'field'])
            ->where('level', 'nasional')
            ->where('is_active', true)
            ->whereDate('deadline', '>=', now())
            ->take(4)->get();

        $deadlineSoon = Competition::with(['category', 'field'])
            ->where('is_active', true)
            ->whereDate('deadline', '>=', now())
            ->whereDate('deadline', '<=', now()->addDays(7))
            ->orderBy('deadline')->take(4)->get();

        $myParticipations = Participation::with(['competition'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['registered', 'in_progress'])
            ->latest()->take(3)->get();

        $totalPart = Participation::where('user_id', $user->id)->count();
        $totalWin = Participation::where('user_id', $user->id)
            ->whereIn('result', ['juara_1', 'juara_2', 'juara_3'])->count();
        $unreadNotif = Notification::where('user_id', $user->id)
            ->where('is_read', false)->count();

        $motivasiList = [
            "Setiap lomba adalah langkah nyata menuju versi terbaik dirimu.",
            "Juara bukan hanya soal menang, tapi soal berani mencoba.",
            "Prestasi besar dimulai dari satu pendaftaran pertama.",
            "Kompetisi bukan tentang mengalahkan orang lain, tapi melampaui diri sendiri.",
            "Tidak ada usaha yang sia-sia, setiap proses membentuk dirimu.",
        ];
        $motivasi = $motivasiList[array_rand($motivasiList)];

        return view('student.dashboard', compact(
            'trending',
            'terbaru',
            'nasional',
            'deadlineSoon',
            'myParticipations',
            'totalPart',
            'totalWin',
            'unreadNotif',
            'motivasi'
        ));
    }
}