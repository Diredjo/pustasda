<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Competition;
use App\Models\Participation;
use App\Models\ParticipationStep;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    // Daftar tim terbuka untuk suatu lomba
    public function index(Request $request)
    {
        $competition = Competition::findOrFail($request->competition_id);
        $teams = Team::with(['leader', 'acceptedMembers.user', 'competition'])
            ->where('competition_id', $competition->id)
            ->where('is_public', true)
            ->where('status', 'open')
            ->get();

        return view('student.teams.index', compact('teams', 'competition'));
    }

    // Form buat tim
    public function create(Request $request)
    {
        $competition = Competition::findOrFail($request->competition_id);
        return view('student.teams.create', compact('competition'));
    }

    // Simpan tim baru
    public function store(Request $request)
    {
        $request->validate([
            'competition_id' => 'required|exists:competitions,id',
            'team_name' => 'required|string|max:200',
            'is_public' => 'boolean',
        ]);

        $competition = Competition::findOrFail($request->competition_id);

        // Cek sudah ada partisipasi belum
        $existing = Participation::where('user_id', auth()->id())
            ->where('competition_id', $competition->id)->first();
        if ($existing) {
            return redirect()->route('student.participations.show', $existing->id)
                ->with('error', 'Kamu sudah terdaftar di lomba ini.');
        }

        $team = Team::create([
            'competition_id' => $competition->id,
            'leader_id' => auth()->id(),
            'team_name' => $request->team_name,
            'invite_code' => strtoupper(Str::random(8)),
            'status' => 'open',
            'is_public' => $request->boolean('is_public'),
        ]);

        // Ketua langsung jadi accepted member
        TeamMember::create([
            'team_id' => $team->id,
            'user_id' => auth()->id(),
            'status' => 'accepted',
        ]);

        // Buat partisipasi untuk ketua
        $participation = Participation::create([
            'user_id' => auth()->id(),
            'competition_id' => $competition->id,
            'team_id' => $team->id,
            'status' => 'registered',
            'result' => 'belum_diisi',
            'current_stage' => 1,
        ]);

        $this->createSteps($participation, $competition);

        return redirect()->route('student.teams.show', $team->id)
            ->with('success', 'Tim berhasil dibuat! Bagikan kode undangan ke temanmu.');
    }

    // Detail tim (room)
    public function show(Team $team)
    {
        $team->load(['leader', 'members.user', 'competition.category']);
        $myMembership = TeamMember::where('team_id', $team->id)
            ->where('user_id', auth()->id())->first();

        return view('student.teams.show', compact('team', 'myMembership'));
    }

    // Form join via kode
    public function joinForm(Request $request)
    {
        $code = $request->code;
        $team = null;
        if ($code) {
            $team = Team::with(['competition', 'leader', 'acceptedMembers.user'])
                ->where('invite_code', strtoupper($code))->first();
        }
        return view('student.teams.join', compact('team', 'code'));
    }

    // Submit join via kode
    public function joinSubmit(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $team = Team::with(['competition', 'acceptedMembers'])
            ->where('invite_code', strtoupper($request->code))
            ->firstOrFail();

        if ($team->status !== 'open') {
            return back()->with('error', 'Tim ini sudah penuh atau ditutup.');
        }

        // Cek sudah member belum
        $isMember = TeamMember::where('team_id', $team->id)
            ->where('user_id', auth()->id())->exists();
        if ($isMember) {
            return redirect()->route('student.teams.show', $team->id)
                ->with('error', 'Kamu sudah bergabung di tim ini.');
        }

        TeamMember::create([
            'team_id' => $team->id,
            'user_id' => auth()->id(),
            'status' => 'accepted',
        ]);

        // Buat partisipasi untuk member baru
        $participation = Participation::create([
            'user_id' => auth()->id(),
            'competition_id' => $team->competition_id,
            'team_id' => $team->id,
            'status' => 'registered',
            'result' => 'belum_diisi',
            'current_stage' => 1,
        ]);

        $this->createSteps($participation, $team->competition);

        // Update status tim jika sudah penuh
        $totalAccepted = $team->acceptedMembers()->count() + 1;
        if ($totalAccepted >= $team->competition->max_members) {
            $team->update(['status' => 'full']);
        }

        // Notif ke ketua
        Notification::create([
            'user_id' => $team->leader_id,
            'type' => 'team_joined',
            'title' => 'Anggota Baru Bergabung',
            'body' => auth()->user()->name . ' bergabung ke tim ' . $team->team_name,
            'icon' => 'fa-users',
            'color' => '#f5a623',
        ]);

        return redirect()->route('student.teams.show', $team->id)
            ->with('success', 'Berhasil bergabung ke tim ' . $team->team_name . '!');
    }

    // Melamar masuk tim publik
    public function apply(Team $team)
    {
        $existing = TeamMember::where('team_id', $team->id)
            ->where('user_id', auth()->id())->first();
        if ($existing) {
            return response()->json(['error' => 'Sudah mengajukan atau sudah bergabung.'], 422);
        }

        TeamMember::create([
            'team_id' => $team->id,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        Notification::create([
            'user_id' => $team->leader_id,
            'type' => 'team_apply',
            'title' => 'Ada yang Ingin Bergabung ke Timmu',
            'body' => auth()->user()->name . ' ingin bergabung ke tim ' . $team->team_name,
            'icon' => 'fa-user-plus',
            'color' => '#e31e25',
        ]);

        return response()->json(['ok' => true, 'message' => 'Lamaran terkirim ke ketua tim!']);
    }

    // Ketua accept/reject member
    public function respond(Request $request, Team $team, TeamMember $member)
    {
        abort_if($team->leader_id !== auth()->id(), 403);

        $request->validate(['action' => 'required|in:accepted,rejected']);

        $member->update(['status' => $request->action]);

        if ($request->action === 'accepted') {
            // Buat partisipasi untuk member yang diterima
            $participation = Participation::create([
                'user_id' => $member->user_id,
                'competition_id' => $team->competition_id,
                'team_id' => $team->id,
                'status' => 'registered',
                'result' => 'belum_diisi',
                'current_stage' => 1,
            ]);
            $this->createSteps($participation, $team->competition);
        }

        Notification::create([
            'user_id' => $member->user_id,
            'type' => 'team_respond',
            'title' => $request->action === 'accepted' ? 'Lamaranmu Diterima!' : 'Lamaranmu Ditolak',
            'body' => 'Permintaanmu bergabung ke tim ' . $team->team_name .
                ($request->action === 'accepted' ? ' telah DITERIMA.' : ' ditolak oleh ketua.'),
            'icon' => $request->action === 'accepted' ? 'fa-check-circle' : 'fa-times-circle',
            'color' => $request->action === 'accepted' ? '#28a745' : '#e31e25',
        ]);

        return response()->json(['ok' => true]);
    }

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