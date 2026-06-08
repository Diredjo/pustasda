@extends('layouts.app-student')
@section('title', 'Beranda')
@php $pageTitle = 'Beranda'; @endphp

@push('styles')
    <style>
        .welcome-banner {
            background: linear-gradient(135deg, var(--red) 0%, var(--red-dark) 55%, #7b0000 100%);
            border-radius: 18px;
            padding: 32px 36px;
            color: #fff;
            position: relative;
            overflow: hidden;
            margin-bottom: 28px;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 260px;
            height: 260px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: 100px;
            width: 180px;
            height: 180px;
            background: rgba(245, 166, 35, 0.15);
            border-radius: 50%;
        }

        .welcome-banner .wb-icon {
            position: absolute;
            right: 36px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 4.5rem;
            opacity: 0.18;
        }

        .welcome-banner .wb-greeting {
            font-size: 0.82rem;
            opacity: 0.8;
            margin-bottom: 4px;
            font-family: var(--font-body);
        }

        .welcome-banner h2 {
            font-size: 1.55rem;
            font-weight: 800;
            margin-bottom: 10px;
            font-family: var(--font-main);
        }

        .welcome-banner .wb-quote {
            font-size: 0.88rem;
            opacity: 0.88;
            font-style: italic;
            max-width: 480px;
            line-height: 1.6;
            border-left: 3px solid rgba(255, 255, 255, 0.4);
            padding-left: 12px;
        }

        .welcome-banner .wb-stats {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .welcome-banner .wb-stat {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 10px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .welcome-banner .wb-stat-val {
            font-family: var(--font-main);
            font-size: 1.4rem;
            font-weight: 800;
            line-height: 1;
        }

        .welcome-banner .wb-stat-lbl {
            font-size: 0.72rem;
            opacity: 0.8;
            margin-top: 2px;
        }

        /* Kategori section header */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .section-header h3 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-header h3 i {
            color: var(--red);
        }

        .section-header a {
            font-size: 0.78rem;
            color: var(--red);
            font-weight: 600;
        }

        .section-header a:hover {
            text-decoration: underline;
        }

        /* Bento category cards (hero) */
        .bento-hero {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 28px;
        }

        .bento-cat-card {
            border-radius: var(--radius);
            padding: 18px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            cursor: pointer;
            transition: all var(--transition);
            border: 1.5px solid transparent;
            text-decoration: none;
        }

        .bento-cat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .bento-cat-card .bcc-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .bento-cat-card .bcc-title {
            font-weight: 800;
            font-size: 0.88rem;
            font-family: var(--font-main);
        }

        .bento-cat-card .bcc-sub {
            font-size: 0.74rem;
            opacity: 0.7;
        }

        /* Kompetisi grid */
        .comp-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        /* Active participation card */
        .active-part-card {
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            padding: 16px;
            display: flex;
            gap: 14px;
            align-items: flex-start;
            transition: all var(--transition);
        }

        .active-part-card:hover {
            box-shadow: var(--shadow);
        }

        .apc-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--red-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--red);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .apc-title {
            font-weight: 700;
            font-size: 0.88rem;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .apc-sub {
            font-size: 0.75rem;
            color: var(--gray);
        }

        .apc-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 20px;
            margin-top: 6px;
        }

        @media(max-width:1100px) {
            .comp-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:900px) {
            .bento-hero {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:600px) {
            .comp-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- Welcome Banner --}}
    <div class="welcome-banner">
        <i class="fa-solid fa-trophy wb-icon"></i>
        <div class="wb-greeting">
            <i class="fa-solid fa-sun"></i>
            Selamat datang kembali,
        </div>
        <h2>{{ auth()->user()->name }} <i class="fa-solid fa-hand-wave" style="font-size:1.2rem; opacity:0.8;"></i></h2>
        <div class="wb-quote">"{{ $motivasi }}"</div>
        <div class="wb-stats">
            <div class="wb-stat">
                <i class="fa-solid fa-list-check" style="opacity:0.8;"></i>
                <div>
                    <div class="wb-stat-val">{{ $totalPart }}</div>
                    <div class="wb-stat-lbl">Lomba Diikuti</div>
                </div>
            </div>
            <div class="wb-stat">
                <i class="fa-solid fa-medal" style="color:var(--yellow);"></i>
                <div>
                    <div class="wb-stat-val">{{ $totalWin }}</div>
                    <div class="wb-stat-lbl">Kali Juara</div>
                </div>
            </div>
            <div class="wb-stat">
                <i class="fa-solid fa-bell" style="opacity:0.8;"></i>
                <div>
                    <div class="wb-stat-val">{{ $unreadNotif }}</div>
                    <div class="wb-stat-lbl">Notif Baru</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kategori Bento --}}
    <div class="section-header">
        <h3><i class="fa-solid fa-grip"></i> Kategori Lomba</h3>
        <a href="{{ route('student.explore') }}">Lihat semua <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <div class="bento-hero">
        <a href="{{ route('student.explore', ['filter' => 'trending']) }}" class="bento-cat-card"
            style="background:linear-gradient(135deg,#fff3f3,#ffe0e0); border-color:#ffcdd2;">
            <div class="bcc-icon" style="background:var(--red);color:#fff;"><i class="fa-solid fa-fire"></i></div>
            <div class="bcc-title" style="color:var(--red);">Lomba Tren</div>
            <div class="bcc-sub" style="color:var(--red);">Paling diminati sekarang</div>
        </a>
        <a href="{{ route('student.explore', ['filter' => 'nasional']) }}" class="bento-cat-card"
            style="background:linear-gradient(135deg,#fff8ec,#ffecd0); border-color:#ffe0b2;">
            <div class="bcc-icon" style="background:var(--yellow);color:#fff;"><i class="fa-solid fa-flag"></i></div>
            <div class="bcc-title" style="color:#c77700;">Lomba Nasional</div>
            <div class="bcc-sub" style="color:#c77700;">Tingkat seluruh Indonesia</div>
        </a>
        <a href="{{ route('student.explore', ['filter' => 'terbaru']) }}" class="bento-cat-card"
            style="background:linear-gradient(135deg,#f0fdf4,#dcfce7); border-color:#bbf7d0;">
            <div class="bcc-icon" style="background:#16a34a;color:#fff;"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <div class="bcc-title" style="color:#15803d;">Lomba Terbaru</div>
            <div class="bcc-sub" style="color:#15803d;">Baru saja ditambahkan</div>
        </a>
        <a href="{{ route('student.explore', ['filter' => 'deadline']) }}" class="bento-cat-card"
            style="background:linear-gradient(135deg,#eff6ff,#dbeafe); border-color:#bfdbfe;">
            <div class="bcc-icon" style="background:#2563eb;color:#fff;"><i class="fa-solid fa-hourglass-half"></i></div>
            <div class="bcc-title" style="color:#1d4ed8;">Deadline Dekat</div>
            <div class="bcc-sub" style="color:#1d4ed8;">Daftar sebelum terlambat</div>
        </a>
    </div>

    {{-- Sedang Ramai Diikuti --}}
    @if($trending->count())
        <div class="section-header">
            <h3><i class="fa-solid fa-fire"></i> Sedang Ramai Diikuti</h3>
            <a href="{{ route('student.explore', ['filter' => 'trending']) }}">Lihat semua <i
                    class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="comp-grid" style="margin-bottom:28px;">
            @foreach($trending as $comp)
                @include('components.comp-card', ['competition' => $comp])
            @endforeach
        </div>
    @endif

    {{-- Lomba Terbaru --}}
    @if($terbaru->count())
        <div class="section-header">
            <h3><i class="fa-solid fa-clock-rotate-left"></i> Lomba Terbaru</h3>
            <a href="{{ route('student.explore', ['filter' => 'terbaru']) }}">Lihat semua <i
                    class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="comp-grid" style="margin-bottom:28px;">
            @foreach($terbaru as $comp)
                @include('components.comp-card', ['competition' => $comp])
            @endforeach
        </div>
    @endif

    {{-- Deadline Dekat --}}
    @if($deadlineSoon->count())
        <div class="section-header">
            <h3><i class="fa-solid fa-hourglass-half" style="color:#2563eb;"></i> Deadline Dekat</h3>
            <a href="{{ route('student.explore', ['filter' => 'deadline']) }}">Lihat semua <i
                    class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="comp-grid" style="margin-bottom:28px;">
            @foreach($deadlineSoon as $comp)
                @include('components.comp-card', ['competition' => $comp])
            @endforeach
        </div>
    @endif

    {{-- Lomba Aktif Saya --}}
    @if($myParticipations->count())
        <div class="section-header">
            <h3><i class="fa-solid fa-person-running"></i> Lomba yang Sedang Saya Ikuti</h3>
            <a href="{{ route('student.participations') }}">Lihat semua <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div style="display:flex; flex-direction:column; gap:10px; margin-bottom:28px;">
            @foreach($myParticipations as $part)
                <a href="{{ route('student.participations.show', $part->id) }}" class="active-part-card"
                    style="text-decoration:none;">
                    <div class="apc-icon"><i class="fa-solid fa-trophy"></i></div>
                    <div style="flex:1;">
                        <div class="apc-title">{{ $part->competition->title }}</div>
                        <div class="apc-sub">
                            <i class="fa-solid fa-building"></i> {{ $part->competition->organizer }}
                            &nbsp;&bull;&nbsp;
                            <i class="fa-solid fa-calendar"></i> Deadline: {{ $part->competition->deadline->format('d M Y') }}
                        </div>
                        @php
                            $statusMap = [
                                'registered' => ['label' => 'Terdaftar', 'color' => 'background:#d1ecf1;color:#0c5460;'],
                                'in_progress' => ['label' => 'Sedang Dikerjakan', 'color' => 'background:#fff3cd;color:#856404;'],
                                'submitted' => ['label' => 'Sudah Submit', 'color' => 'background:#d4edda;color:#155724;'],
                                'not_submitted' => ['label' => 'Tidak Submit', 'color' => 'background:#f8d7da;color:#721c24;'],
                                'completed' => ['label' => 'Selesai', 'color' => 'background:#d4edda;color:#155724;'],
                            ];
                            $st = $statusMap[$part->status] ?? ['label' => $part->status, 'color' => ''];
                        @endphp
                        <span class="apc-status" style="{{ $st['color'] }}">
                            <i class="fa-solid fa-circle" style="font-size:0.5rem;"></i>
                            {{ $st['label'] }}
                        </span>
                    </div>
                    <div>
                        @if($part->competition->deadline->isFuture())
                            <div id="cd-dash-{{ $part->id }}" style="font-size:0.75rem;"></div>
                            <script>
                                document.addEventListener('DOMContentLoaded', () =>
                                    startCountdown('{{ $part->competition->deadline->toIso8601String() }}', 'cd-dash-{{ $part->id }}')
                                );
                            </script>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    {{-- Leaderboard Preview --}}
    <div class="section-header">
        <h3><i class="fa-solid fa-ranking-star"></i> Leaderboard Siswa Berprestasi</h3>
        <a href="{{ route('student.leaderboard') }}">Lihat semua <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <div class="card" style="padding:8px 0; margin-bottom:28px;">
        @php
            $topStudents = \App\Models\User::where('role', 'student')
                ->withCount([
                    'participations as win_count' => function ($q) {
                        $q->whereIn('result', ['juara_1', 'juara_2', 'juara_3']);
                    }
                ])
                ->withCount('participations as total_part')
                ->orderByDesc('win_count')
                ->orderByDesc('total_part')
                ->take(5)->get();
            $rankIcons = ['fa-crown', 'fa-medal', 'fa-award', 'fa-star', 'fa-ribbon'];
        @endphp
        @forelse($topStudents as $i => $student)
            <div class="lb-row">
                <div class="lb-rank rank-{{ $i + 1 }}">
                    @if($i < 3)
                        <i class="fa-solid {{ $rankIcons[$i] }}"></i>
                    @else
                        {{ $i + 1 }}
                    @endif
                </div>
                <div class="lb-avatar">{{ strtoupper(substr($student->name, 0, 2)) }}</div>
                <div class="lb-info">
                    <div class="lb-name">{{ $student->name }}
                        @if($student->id === auth()->id())
                            <span
                                style="font-size:0.7rem;background:var(--red-light);color:var(--red);padding:2px 6px;border-radius:10px;margin-left:4px;">Kamu</span>
                        @endif
                    </div>
                    <div class="lb-sub">
                        {{ $student->studentProfile->jurusan ?? '-' }} &bull;
                        {{ $student->total_part }} lomba diikuti
                    </div>
                </div>
                <div class="lb-score">{{ $student->win_count }} <span
                        style="font-size:0.7rem;font-weight:400;color:var(--gray);">juara</span></div>
            </div>
        @empty
            <div class="empty-state"><i class="fa-solid fa-trophy"></i>
                <p>Belum ada data leaderboard</p>
            </div>
        @endforelse
    </div>

@endsection