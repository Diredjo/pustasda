<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\Participation;
use App\Models\Competition;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $pendingMentors = Mentorship::with(['participation.competition', 'participation.user.studentProfile'])
            ->where('teacher_id', $user->id)
            ->where('status', 'pending')
            ->latest()->get();

        $activeMentors = Mentorship::with(['participation.competition', 'participation.user.studentProfile', 'participation.steps'])
            ->where('teacher_id', $user->id)
            ->where('status', 'accepted')
            ->whereHas('participation', fn($q) => $q->whereIn('status', ['registered', 'in_progress', 'submitted']))
            ->latest()->get();

        $completedMentors = Mentorship::with(['participation.competition', 'participation.user'])
            ->where('teacher_id', $user->id)
            ->where('status', 'accepted')
            ->whereHas('participation', fn($q) => $q->where('status', 'completed'))
            ->count();

        $totalMentored = Mentorship::where('teacher_id', $user->id)->where('status', 'accepted')->count();
        $totalWins = Mentorship::where('teacher_id', $user->id)
            ->where('status', 'accepted')
            ->whereHas('participation', fn($q) => $q->whereIn('result', ['juara_1', 'juara_2', 'juara_3']))
            ->count();

        $latestComps = Competition::with('category')
            ->where('is_active', true)
            ->whereDate('deadline', '>=', now())
            ->latest()->take(5)->get();

        return view('teacher.dashboard', compact(
            'pendingMentors',
            'activeMentors',
            'completedMentors',
            'totalMentored',
            'totalWins',
            'latestComps'
        ));
    }
}