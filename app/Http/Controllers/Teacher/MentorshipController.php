<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\Notification;
use App\Models\Participation;
use Illuminate\Http\Request;

class MentorshipController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $pending = Mentorship::with(['participation.competition', 'participation.user.studentProfile'])
            ->where('teacher_id', $user->id)->where('status', 'pending')->latest()->get();

        $accepted = Mentorship::with(['participation.competition', 'participation.user.studentProfile', 'participation.steps'])
            ->where('teacher_id', $user->id)->where('status', 'accepted')->latest()->get();

        $rejected = Mentorship::with(['participation.competition', 'participation.user'])
            ->where('teacher_id', $user->id)->where('status', 'rejected')->latest()->take(10)->get();

        return view('teacher.mentorships', compact('pending', 'accepted', 'rejected'));
    }

    public function respond(Request $request, Mentorship $mentorship)
    {
        // Pastikan mentorship ini ditujukan ke guru yang login
        abort_if($mentorship->teacher_id !== auth()->id(), 403);

        $request->validate(['action' => 'required|in:accept,reject']);

        $status = $request->action === 'accept' ? 'accepted' : 'rejected';

        $mentorship->update([
            'status' => $status,
            'responded_at' => now(),
        ]);

        // Notif ke siswa
        $studentId = $mentorship->participation->user_id;
        $compTitle = $mentorship->participation->competition->title;

        if ($status === 'accepted') {
            Notification::create([
                'user_id' => $studentId,
                'type' => 'mentorship_accepted',
                'title' => 'Guru Pembimbing Dikonfirmasi!',
                'body' => auth()->user()->name . ' bersedia membimbing kamu di lomba "' . $compTitle . '".',
                'icon' => 'fa-chalkboard-teacher',
                'color' => '#16a34a',
                'data' => ['mentorship_id' => $mentorship->id],
            ]);
        } else {
            Notification::create([
                'user_id' => $studentId,
                'type' => 'mentorship_rejected',
                'title' => 'Permintaan Pembimbing Ditolak',
                'body' => auth()->user()->name . ' tidak dapat membimbing kamu di lomba "' . $compTitle . '" saat ini.',
                'icon' => 'fa-circle-xmark',
                'color' => '#e31e25',
                'data' => ['mentorship_id' => $mentorship->id],
            ]);
        }

        return back()->with('success', 'Respons berhasil dikirim.');
    }

    public function show(Mentorship $mentorship)
    {
        abort_if($mentorship->teacher_id !== auth()->id(), 403);
        $mentorship->load([
            'participation.competition.stages',
            'participation.user.studentProfile',
            'participation.steps',
            'participation.team.members.user',
        ]);
        return view('teacher.mentorship-detail', compact('mentorship'));
    }
}