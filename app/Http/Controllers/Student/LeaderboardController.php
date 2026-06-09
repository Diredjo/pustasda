<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Participation;

class LeaderboardController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')
            ->with('studentProfile')
            ->withCount([
                'participations as total_part',
                'participations as win_count' => fn($q) =>
                    $q->whereIn('result', ['juara_1', 'juara_2', 'juara_3']),
                'participations as submitted_count' => fn($q) =>
                    $q->where('status', 'submitted'),
            ])
            ->orderByDesc('win_count')
            ->orderByDesc('total_part')
            ->take(50)
            ->get();

        // Hitung skor (juara1=3poin, juara2=2poin, juara3=1poin)
        $students = $students->map(function ($s) {
            $j1 = Participation::where('user_id', $s->id)->where('result', 'juara_1')->count();
            $j2 = Participation::where('user_id', $s->id)->where('result', 'juara_2')->count();
            $j3 = Participation::where('user_id', $s->id)->where('result', 'juara_3')->count();
            $s->score = ($j1 * 3) + ($j2 * 2) + ($j3 * 1);
            return $s;
        })->sortByDesc('score')->values();

        $myRank = $students->search(fn($s) => $s->id === auth()->id());

        return view('student.leaderboard', compact('students', 'myRank'));
    }
}