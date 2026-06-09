@extends('layouts.app-teacher')
@section('title', 'Dashboard Guru')
@php $pageTitle = 'Dashboard Guru'; @endphp

@push('styles')
    <style>
        .stat-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .mentor-card {
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            padding: 18px;
            transition: box-shadow .2s;
        }

        .mentor-card:hover {
            box-shadow: var(--shadow);
        }

        .mc-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .mc-avatar {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--red), var(--yellow));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .82rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .mc-name {
            font-weight: 700;
            font-size: .88rem;
        }

        .mc-sub {
            font-size: .75rem;
            color: var(--gray);
        }

        .mc-comp {
            font-size: .82rem;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            gap: 6px;
            align-items: flex-start;
        }

        .mc-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .wa-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: .8rem;
            font-weight: 700;
            background: #25d366;
            color: #fff;
            text-decoration: none;
            transition: opacity .2s;
        }

        .wa-btn:hover {
            opacity: .88;
        }

        .pending-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: .72rem;
            font-weight: 700;
            background: #fff3cd;
            color: #856404;
        }

        .latest-comp-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid var(--gray-light);
        }

        .latest-comp-row:last-child {
            border-bottom: none;
        }

        @media(max-width:900px) {
            .stat-grid-3 {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- Stats --}}
    <div class="stat-grid-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff3f3;color:var(--red);"><i class="fa-solid fa-clock"></i></div>
            <div>
                <div class="stat-val">{{ $pendingMentors->count() }}</div>
                <div class="stat-lbl">Permintaan Bimbingan</div>
                @if($pendingMentors->count() > 0)
                    <div class="stat-sub" style="color:var(--red);"><i class="fa-solid fa-triangle-exclamation"
                            style="font-size:.7rem;"></i> Perlu ditanggapi</div>
                @endif
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff8ec;color:var(--yellow);"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="stat-val">{{ $totalMentored }}</div>
                <div class="stat-lbl">Total Siswa Dibimbing</div>
                <div class="stat-sub text-gray"><i class="fa-solid fa-circle"
                        style="font-size:.4rem;color:var(--yellow);"></i> Sepanjang waktu</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4;color:#16a34a;"><i class="fa-solid fa-medal"></i></div>
            <div>
                <div class="stat-val">{{ $totalWins }}</div>
                <div class="stat-lbl">Siswa Bimbingan Juara</div>
                <div class="stat-sub" style="color:#16a34a;"><i class="fa-solid fa-trophy" style="font-size:.7rem;"></i>
                    Juara 1, 2, atau 3</div>
            </div>
        </div>
    </div>

    {{-- Permintaan Pending --}}
    @if($pendingMentors->count() > 0)
        <div class="section-header" style="margin-bottom:14px;">
            <h3 style="font-size:1rem;font-weight:800;display:flex;align-items:center;gap:8px;">
                <i class="fa-solid fa-bell text-red"></i> Permintaan Bimbingan Baru
                <span
                    style="background:var(--red);color:#fff;font-size:.7rem;padding:2px 8px;border-radius:20px;">{{ $pendingMentors->count() }}</span>
            </h3>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:14px;margin-bottom:28px;">
            @foreach($pendingMentors as $m)
                @php $siswa = $m->participation->user;
                $comp = $m->participation->competition; @endphp
                <div class="mentor-card" style="border-color:#ffeeba;">
                    <div class="mc-header">
                        <div class="mc-avatar">{{ strtoupper(substr($siswa->name, 0, 2)) }}</div>
                        <div>
                            <div class="mc-name">{{ $siswa->name }}</div>
                            <div class="mc-sub">
                                {{ $siswa->studentProfile->kelas ?? '' }} {{ $siswa->studentProfile->jurusan ?? '' }}
                            </div>
                        </div>
                        <span class="pending-badge" style="margin-left:auto;"><i class="fa-solid fa-clock"></i> Menunggu</span>
                    </div>
                    <div class="mc-comp">
                        <i class="fa-solid fa-trophy text-red" style="margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <div style="font-weight:700;">{{ Str::limit($comp->title, 50) }}</div>
                            <div style="font-size:.75rem;color:var(--gray);">{{ $comp->organizer }}</div>
                        </div>
                    </div>
                    <div class="mc-actions">
                        <form method="POST" action="{{ route('teacher.mentorships.respond', $m) }}" style="display:inline;">
                            @csrf
                            <input type="hidden" name="action" value="accept">
                            <button type="submit" class="btn btn-sm"
                                style="background:#d4edda;color:#155724;border:1px solid #c3e6cb;">
                                <i class="fa-solid fa-check"></i> Terima
                            </button>
                        </form>
                        <form method="POST" action="{{ route('teacher.mentorships.respond', $m) }}" style="display:inline;">
                            @csrf
                            <input type="hidden" name="action" value="reject">
                            <button type="submit" class="btn btn-sm"
                                style="background:#f8d7da;color:#721c24;border:1px solid #f5c6cb;">
                                <i class="fa-solid fa-xmark"></i> Tolak
                            </button>
                        </form>
                        @if($siswa->wa_number)
                            <a href="https://wa.me/{{ $siswa->wa_number }}?text={{ urlencode('Halo ' . $siswa->name . ', saya ' . $m->teacher->name . ' dari PUSTASDA. Saya akan membahas bimbingan lomba "' . $comp->title . '" dengan kamu.') }}"
                                target="_blank" class="wa-btn btn-sm">
                                <i class="fa-brands fa-whatsapp"></i> WA
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Bimbingan Aktif --}}
    @if($activeMentors->count() > 0)
        <div class="section-header" style="margin-bottom:14px;">
            <h3 style="font-size:1rem;font-weight:800;display:flex;align-items:center;gap:8px;">
                <i class="fa-solid fa-person-running text-yellow"></i> Bimbingan Sedang Berjalan
            </h3>
            <a href="{{ route('teacher.mentorships') }}" style="font-size:.78rem;color:var(--red);font-weight:600;">Lihat
                semua</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:14px;margin-bottom:28px;">
            @foreach($activeMentors->take(6) as $m)
                @php
                    $siswa = $m->participation->user;
                    $comp = $m->participation->competition;
                    $steps = $m->participation->steps;
                    $doneSteps = $steps->where('is_confirmed', true)->count();
                    $totalSteps = $steps->count();
                    $pct = $totalSteps > 0 ? round($doneSteps / $totalSteps * 100) : 0;
                    $statusMap = ['registered' => ['Terdaftar', '#d1ecf1', '#0c5460'], 'in_progress' => ['Sedang Proses', '#fff3cd', '#856404'], 'submitted' => ['Sudah Submit', '#d4edda', '#155724'], 'completed' => ['Selesai', '#d4edda', '#155724']];
                    $st = $statusMap[$m->participation->status] ?? [$m->participation->status, '#eee', '#333'];
                @endphp
                <div class="mentor-card">
                    <div class="mc-header">
                        <div class="mc-avatar">{{ strtoupper(substr($siswa->name, 0, 2)) }}</div>
                        <div>
                            <div class="mc-name">{{ $siswa->name }}</div>
                            <div class="mc-sub">{{ $siswa->studentProfile->kelas ?? '' }}
                                {{ $siswa->studentProfile->jurusan ?? '' }}</div>
                        </div>
                        <span
                            style="margin-left:auto;font-size:.7rem;font-weight:700;padding:3px 9px;border-radius:20px;background:{{ $st[1] }};color:{{ $st[2] }};">
                            {{ $st[0] }}
                        </span>
                    </div>
                    <div class="mc-comp">
                        <i class="fa-solid fa-trophy text-red" style="margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <div style="font-weight:700;">{{ Str::limit($comp->title, 48) }}</div>
                            <div style="font-size:.72rem;color:var(--gray);">Deadline: {{ $comp->deadline->format('d M Y') }}</div>
                        </div>
                    </div>

                    {{-- Progress bar --}}
                    @if($totalSteps > 0)
                        <div style="margin-bottom:10px;">
                            <div
                                style="display:flex;justify-content:space-between;font-size:.72rem;color:var(--gray);margin-bottom:4px;">
                                <span>Progres Siswa</span>
                                <span>{{ $doneSteps }}/{{ $totalSteps }} step ({{ $pct }}%)</span>
                            </div>
                            <div style="background:var(--gray-mid);border-radius:10px;height:6px;">
                                <div
                                    style="background:var(--red);height:6px;border-radius:10px;width:{{ $pct }}%;transition:width .4s;">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mc-actions">
                        <a href="{{ route('teacher.mentorships.show', $m) }}" class="btn btn-sm btn-secondary">
                            <i class="fa-solid fa-eye"></i> Detail
                        </a>
                        @if($siswa->wa_number)
                            <a href="https://wa.me/{{ $siswa->wa_number }}?text={{ urlencode('Halo ' . $siswa->name . ', saya ingin menanyakan perkembangan lomba "' . $comp->title . '" kamu.') }}"
                                target="_blank" class="wa-btn">
                                <i class="fa-brands fa-whatsapp"></i> Hubungi via WA
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Lomba Terbaru --}}
    <div class="section-header" style="margin-bottom:14px;">
        <h3 style="font-size:1rem;font-weight:800;display:flex;align-items:center;gap:8px;">
            <i class="fa-solid fa-trophy text-red"></i> Lomba Aktif Terbaru
        </h3>
    </div>
    <div class="card" style="padding:8px 0;">
        @foreach($latestComps as $c)
            @php $lvl = ['nasional' => 'level-nasional', 'provinsi' => 'level-provinsi', 'kota' => 'level-kota', 'internasional' => 'level-internasional', 'sekolah' => 'level-sekolah']; @endphp
            <div class="latest-comp-row" style="padding:10px 18px;">
                <div
                    style="width:38px;height:38px;border-radius:10px;background:var(--red-light);display:flex;align-items:center;justify-content:center;color:var(--red);flex-shrink:0;">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <div style="flex:1;">
                    <div style="font-weight:700;font-size:.85rem;">{{ Str::limit($c->title, 55) }}</div>
                    <div style="font-size:.74rem;color:var(--gray);">
                        {{ $c->organizer }} &bull; Deadline {{ $c->deadline->format('d M Y') }}
                    </div>
                </div>
                <span class="comp-tag {{ $lvl[$c->level] ?? '' }}">{{ ucfirst($c->level) }}</span>
            </div>
        @endforeach
    </div>

@endsection