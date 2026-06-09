@extends('layouts.app-student')
@section('title', 'Leaderboard')
@php $pageTitle = 'Leaderboard Siswa'; @endphp

@push('styles')
    <style>
    .lb-podium {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        gap: 12px;
        margin-bottom: 28px;
        padding: 24px 0 0;
    }
    .podium-item {
        display: flex; flex-direction: column; align-items: center;
        text-align: center;
    }
    .podium-avatar {
        width: 56px; height: 56px; border-radius: 14px;
        background: linear-gradient(135deg, var(--red), var(--yellow));
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.1rem; font-weight: 800;
        margin-bottom: 8px;
        position: relative;
    }
    .podium-crown {
        position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
        font-size: 1rem;
    }
    .podium-name  { font-size: 0.78rem; font-weight: 700; margin-bottom: 2px; }
    .podium-score { font-size: 0.72rem; color: var(--gray); }
    .podium-block {
        border-radius: 10px 10px 0 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; font-weight: 800;
    }
    .podium-1 .podium-block { width:90px; height:90px; background:linear-gradient(135deg,#f5a623,#e59400); color:#fff; }
    .podium-2 .podium-block { width:80px; height:70px; background:linear-gradient(135deg,#9e9e9e,#757575); color:#fff; }
    .podium-3 .podium-block { width:80px; height:54px; background:linear-gradient(135deg,#8d6e63,#6d4c41); color:#fff; }

    .lb-table-card {
        background: var(--white);
        border: 1.5px solid var(--gray-mid);
        border-radius: var(--radius);
        overflow: hidden;
    }
    .lb-table-header {
        padding: 14px 20px;
        border-bottom: 1px solid var(--gray-mid);
        display: flex; align-items: center; justify-content: space-between;
        background: var(--bg);
    }

    .lb-row-full {
        display: grid;
        grid-template-columns: 40px 1fr 80px 80px 80px 80px;
        align-items: center;
        padding: 12px 20px;
        border-bottom: 1px solid var(--gray-light);
        transition: background var(--transition);
        font-size: 0.84rem;
    }
    .lb-row-full:hover { background: var(--gray-light); }
    .lb-row-full.mine  { background: var(--red-light); }
    .lb-row-full:last-child { border-bottom: none; }
    .lb-col-header {
        grid-template-columns: 40px 1fr 80px 80px 80px 80px;
        font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.8px; color: var(--gray);
        padding: 10px 20px;
        border-bottom: 2px solid var(--gray-mid);
        display: grid; align-items: center;
        background: var(--bg);
    }
    .my-rank-banner {
        background: linear-gradient(135deg, var(--red), var(--red-dark));
        color: #fff; padding: 14px 20px;
        display: flex; align-items: center; gap: 12px;
        font-size: 0.88rem;
        margin-bottom: 20px;
        border-radius: var(--radius);
    }
    </style>
@endpush

@section('content')

    <div class="page-header">
        <h1><i class="fa-solid fa-ranking-star text-red"></i> Leaderboard Siswa Berprestasi</h1>
        <p>Peringkat berdasarkan akumulasi poin juara (J1=3, J2=2, J3=1)</p>
    </div>

    {{-- My rank banner --}}
    @if($myRank !== false)
        <div class="my-rank-banner">
            <i class="fa-solid fa-user-circle" style="font-size:1.4rem;"></i>
            <div>
                <div style="font-weight:800;">Posisimu saat ini: Peringkat #{{ $myRank + 1 }}</div>
                <div style="opacity:0.85; font-size:0.8rem;">
                    Skor: {{ $students[$myRank]->score ?? 0 }} poin &bull;
                    {{ $students[$myRank]->win_count ?? 0 }} kali juara &bull;
                    {{ $students[$myRank]->total_part ?? 0 }} lomba diikuti
                </div>
            </div>
        </div>
    @endif

    {{-- Podium TOP 3 --}}
    @if($students->count() >= 3)
        <div class="lb-podium">
            {{-- Posisi 2 --}}
            <div class="podium-item podium-2">
                <div class="podium-avatar">{{ strtoupper(substr($students[1]->name, 0, 2)) }}</div>
                <div class="podium-name">{{ Str::limit($students[1]->name, 12) }}</div>
                <div class="podium-score">{{ $students[1]->score }} poin</div>
                <div class="podium-block">2</div>
            </div>
            {{-- Posisi 1 --}}
            <div class="podium-item podium-1">
                <div class="podium-avatar" style="width:68px; height:68px; font-size:1.2rem;">
                    <i class="fa-solid fa-crown podium-crown" style="color:var(--yellow);"></i>
                    {{ strtoupper(substr($students[0]->name, 0, 2)) }}
                </div>
                <div class="podium-name" style="font-size:0.88rem;">{{ Str::limit($students[0]->name, 14) }}</div>
                <div class="podium-score" style="font-weight:700; color:var(--yellow);">{{ $students[0]->score }} poin</div>
                <div class="podium-block">1</div>
            </div>
            {{-- Posisi 3 --}}
            <div class="podium-item podium-3">
                <div class="podium-avatar">{{ strtoupper(substr($students[2]->name, 0, 2)) }}</div>
                <div class="podium-name">{{ Str::limit($students[2]->name, 12) }}</div>
                <div class="podium-score">{{ $students[2]->score }} poin</div>
                <div class="podium-block">3</div>
            </div>
        </div>
    @endif

    {{-- Tabel lengkap --}}
    <div class="lb-table-card">
        <div class="lb-table-header">
            <h4><i class="fa-solid fa-table-list text-red"></i> Peringkat Lengkap</h4>
            <span style="font-size:0.78rem; color:var(--gray);">{{ $students->count() }} siswa terdaftar</span>
        </div>
        <div class="lb-col-header">
            <span>#</span>
            <span>Siswa</span>
            <span style="text-align:center;">Poin</span>
            <span style="text-align:center;">Juara</span>
            <span style="text-align:center;">Lomba</span>
            <span style="text-align:center;">Submit</span>
        </div>
        @foreach($students as $i => $student)
            <div class="lb-row-full {{ $student->id === auth()->id() ? 'mine' : '' }}">
                <div class="lb-rank {{ $i < 3 ? 'rank-' . ($i + 1) : '' }}" style="font-size:0.9rem; font-weight:800;">
                    @if($i === 0) <i class="fa-solid fa-crown" style="color:#f5a623;"></i>
                    @elseif($i === 1) <i class="fa-solid fa-medal" style="color:#9e9e9e;"></i>
                    @elseif($i === 2) <i class="fa-solid fa-award" style="color:#8d6e63;"></i>
                    @else {{ $i + 1 }}
                    @endif
                </div>
                <div style="display:flex; align-items:center; gap:10px;">
                    <div class="lb-avatar" style="width:34px; height:34px; border-radius:8px; font-size:0.72rem;">
                        {{ strtoupper(substr($student->name, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-weight:700;">
                            {{ $student->name }}
                            @if($student->id === auth()->id())
                                <span style="font-size:0.65rem; background:var(--red); color:#fff; padding:1px 6px; border-radius:10px; margin-left:4px;">Kamu</span>
                            @endif
                        </div>
                        <div style="font-size:0.72rem; color:var(--gray);">
                            {{ $student->studentProfile->jurusan ?? '-' }}
                            {{ $student->studentProfile->kelas ? '· Kelas ' . $student->studentProfile->kelas : '' }}
                        </div>
                    </div>
                </div>
                <div style="text-align:center; font-family:var(--font-main); font-weight:800; color:var(--red);">
                    {{ $student->score }}
                </div>
                <div style="text-align:center;">
                    <span style="font-size:0.78rem; background:var(--yellow-light); color:#c77700; padding:2px 8px; border-radius:10px; font-weight:700;">
                        {{ $student->win_count }}
                    </span>
                </div>
                <div style="text-align:center; color:var(--gray); font-weight:600;">{{ $student->total_part }}</div>
                <div style="text-align:center; color:var(--gray); font-weight:600;">{{ $student->submitted_count }}</div>
            </div>
        @endforeach
    </div>

@endsection