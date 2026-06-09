@extends('layouts.app-student')
@section('title', 'Lomba Saya')
@php $pageTitle = 'Lomba Saya'; @endphp

@push('styles')
    <style>
        .part-card {
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 16px;
            transition: all var(--transition);
        }

        .part-card:hover {
            box-shadow: var(--shadow-md);
        }

        .part-card-header {
            display: flex;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--gray-light);
        }

        .part-cover {
            width: 90px;
            height: 70px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            flex-shrink: 0;
            background: linear-gradient(135deg, #fff3f3, #ffe0e0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--red);
            font-size: 1.5rem;
        }

        .part-cover img {
            width: 90px;
            height: 70px;
            border-radius: var(--radius-sm);
            object-fit: cover;
        }

        .part-info {
            flex: 1;
        }

        .part-title {
            font-weight: 800;
            font-size: 0.95rem;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .part-org {
            font-size: 0.78rem;
            color: var(--gray);
            margin-bottom: 8px;
        }

        .part-meta {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .part-card-body {
            padding: 16px 20px;
        }

        /* Step progress visual */
        .step-progress {
            display: flex;
            align-items: center;
            gap: 0;
            margin-bottom: 14px;
        }

        .sp-step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .sp-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 14px;
            left: 50%;
            right: -50%;
            height: 2px;
            background: var(--gray-mid);
            z-index: 0;
        }

        .sp-step.done::after {
            background: var(--red);
        }

        .sp-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid var(--gray-mid);
            background: var(--white);
            color: var(--gray);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            z-index: 1;
            position: relative;
            transition: all var(--transition);
        }

        .sp-step.done .sp-dot {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
        }

        .sp-step.active .sp-dot {
            background: var(--yellow);
            border-color: var(--yellow);
            color: #fff;
            box-shadow: 0 0 0 4px var(--yellow-light);
        }

        .sp-label {
            font-size: 0.65rem;
            color: var(--gray);
            margin-top: 5px;
            text-align: center;
        }

        .sp-step.done .sp-label,
        .sp-step.active .sp-label {
            color: var(--dark);
            font-weight: 600;
        }

        .part-card-footer {
            padding: 12px 20px;
            border-top: 1px solid var(--gray-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg);
        }

        .part-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .part-tab {
            padding: 7px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1.5px solid var(--gray-mid);
            background: var(--white);
            color: var(--gray);
            cursor: pointer;
            transition: all var(--transition);
        }

        .part-tab.active {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
        }
    </style>
@endpush

@section('content')

    <div class="page-header">
        <h1><i class="fa-solid fa-list-check text-red"></i> Lomba yang Saya Ikuti</h1>
        <p>Pantau progres dan konfirmasi perkembangan lombamu</p>
    </div>

    {{-- Tabs --}}
    <div class="part-tabs">
        <button class="part-tab active" onclick="filterPart('all', this)">
            <i class="fa-solid fa-border-all"></i> Semua ({{ $participations->count() }})
        </button>
        <button class="part-tab" onclick="filterPart('active', this)">
            <i class="fa-solid fa-person-running"></i> Aktif
        </button>
        <button class="part-tab" onclick="filterPart('completed', this)">
            <i class="fa-solid fa-check-circle"></i> Selesai
        </button>
    </div>

    @forelse($participations as $part)
        @php
            $stepsDone = $part->steps->where('is_confirmed', true)->count();
            $stepsTotal = $part->steps->count();
            $stepMap = [
                'registered' => 1,
                'in_progress' => 2,
                'submitted' => 3,
                'not_submitted' => 3,
                'completed' => 4,
            ];
            $currentStep = $stepMap[$part->status] ?? 1;
            $statusLabels = [
                'registered' => ['label' => 'Terdaftar', 'color' => 'background:#d1ecf1;color:#0c5460;'],
                'in_progress' => ['label' => 'Sedang Dikerjakan', 'color' => 'background:#fff3cd;color:#856404;'],
                'submitted' => ['label' => 'Sudah Submit', 'color' => 'background:#d4edda;color:#155724;'],
                'not_submitted' => ['label' => 'Tidak Submit', 'color' => 'background:#f8d7da;color:#721c24;'],
                'completed' => ['label' => 'Selesai', 'color' => 'background:#d4edda;color:#155724;'],
            ];
            $st = $statusLabels[$part->status] ?? ['label' => $part->status, 'color' => ''];
            $resultLabels = [
                'juara_1' => ['label' => 'Juara 1', 'icon' => 'fa-crown', 'color' => '#f5a623'],
                'juara_2' => ['label' => 'Juara 2', 'icon' => 'fa-medal', 'color' => '#9e9e9e'],
                'juara_3' => ['label' => 'Juara 3', 'icon' => 'fa-award', 'color' => '#8d6e63'],
                'juara_harapan' => ['label' => 'Harapan', 'icon' => 'fa-star-half', 'color' => '#f5a623'],
                'favorit' => ['label' => 'Favorit', 'icon' => 'fa-heart', 'color' => 'var(--red)'],
                'terpilih' => ['label' => 'Terpilih', 'icon' => 'fa-check', 'color' => '#28a745'],
                'lolos_tahap' => ['label' => 'Lolos Tahap', 'icon' => 'fa-arrow-right', 'color' => '#17a2b8'],
                'tidak_lolos' => ['label' => 'Tidak Lolos', 'icon' => 'fa-times', 'color' => '#6c757d'],
                'belum_diisi' => ['label' => 'Belum Diisi', 'icon' => 'fa-question', 'color' => '#6c757d'],
            ];
            $res = $resultLabels[$part->result] ?? $resultLabels['belum_diisi'];
        @endphp
        <div class="part-card"
            data-status="{{ in_array($part->status, ['registered', 'in_progress']) ? 'active' : 'completed' }}">
            <div class="part-card-header">
                {{-- Cover --}}
                <div class="part-cover">
                    @if($part->competition->cover && file_exists(public_path('storage/' . $part->competition->cover)))
                        <img src="{{ asset('storage/' . $part->competition->cover) }}" alt="">
                    @else
                        <i class="fa-solid fa-trophy"></i>
                    @endif
                </div>

                {{-- Info --}}
                <div class="part-info">
                    <div class="part-title">{{ $part->competition->title }}</div>
                    <div class="part-org"><i class="fa-solid fa-building"></i> {{ $part->competition->organizer }}</div>
                    <div class="part-meta">
                        <span class="comp-tag" style="{{ $st['color'] }}">
                            <i class="fa-solid fa-circle" style="font-size:0.45rem;"></i>
                            {{ $st['label'] }}
                        </span>
                        @if($part->team)
                            <span class="comp-tag type-team">
                                <i class="fa-solid fa-users"></i> {{ $part->team->team_name }}
                            </span>
                        @endif
                        @if($part->result !== 'belum_diisi')
                            <span class="comp-tag" style="background:#fff8ec;color:{{ $res['color'] }};">
                                <i class="fa-solid {{ $res['icon'] }}"></i> {{ $res['label'] }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Countdown --}}
                <div style="flex-shrink:0; text-align:right;">
                    @if($part->competition->deadline->isFuture())
                        <div style="font-size:0.7rem; color:var(--gray); margin-bottom:4px;">Deadline:</div>
                        <div id="cd-part-{{ $part->id }}"></div>
                        <script>
                            document.addEventListener('DOMContentLoaded', () =>
                                startCountdown('{{ $part->competition->deadline->toIso8601String() }}', 'cd-part-{{ $part->id }}')
                            );
                        </script>
                    @else
                        <span class="comp-tag" style="background:#f8d7da;color:#721c24;">
                            <i class="fa-solid fa-calendar-xmark"></i> Berakhir
                        </span>
                    @endif
                </div>
            </div>

            <div class="part-card-body">
                {{-- Step Progress --}}
                <div style="font-size:0.75rem; color:var(--gray); margin-bottom:8px; font-weight:600;">
                    <i class="fa-solid fa-shoe-prints text-red"></i> PROGRES LANGKAH
                </div>
                <div class="step-progress">
                    @foreach($part->steps->sortBy('step_order') as $step)
                        @php
                            $isDone = $step->is_confirmed;
                            $isActive = !$isDone && $step->step_order === $currentStep;
                        @endphp
                        <div class="sp-step {{ $isDone ? 'done' : ($isActive ? 'active' : '') }}">
                            <div class="sp-dot">
                                @if($isDone)
                                    <i class="fa-solid fa-check"></i>
                                @elseif($isActive)
                                    <i class="fa-solid fa-spinner fa-spin"></i>
                                @else
                                    {{ $step->step_order }}
                                @endif
                            </div>
                            <div class="sp-label">{{ $step->step_name }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- Mentor info --}}
                @if($part->mentorship)
                    <div
                        style="font-size:0.8rem; display:flex; align-items:center; gap:8px; padding:8px 12px; background:var(--gray-light); border-radius:var(--radius-sm);">
                        <i class="fa-solid fa-chalkboard-teacher text-red"></i>
                        <span>Pembimbing: <strong>{{ $part->mentorship->teacher->name ?? '-' }}</strong></span>
                        <span class="comp-tag {{ $part->mentorship->status === 'accepted' ? '' : 'deadline-soon' }}"
                            style="{{ $part->mentorship->status === 'accepted' ? 'background:#d4edda;color:#155724;' : '' }}">
                            {{ $part->mentorship->status === 'pending' ? 'Menunggu' : ($part->mentorship->status === 'accepted' ? 'Disetujui' : 'Ditolak') }}
                        </span>
                    </div>
                @endif
            </div>

            <div class="part-card-footer">
                <div style="font-size:0.75rem; color:var(--gray);">
                    <i class="fa-solid fa-calendar"></i> Daftar: {{ $part->created_at->format('d M Y') }}
                </div>
                <a href="{{ route('student.participations.show', $part->id) }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-arrow-right"></i> Detail & Aksi
                </a>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="fa-solid fa-inbox"></i>
            <h3>Belum mengikuti lomba</h3>
            <p>Eksplor lomba dan mulai ikuti untuk membangun prestasi kamu!</p>
            <a href="{{ route('student.explore') }}" class="btn btn-primary" style="margin-top:8px;">
                <i class="fa-solid fa-compass"></i> Eksplor Lomba
            </a>
        </div>
    @endforelse

@endsection

@push('scripts')
    <script>
        function filterPart(type, el) {
            document.querySelectorAll('.part-tab').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
            document.querySelectorAll('.part-card').forEach(card => {
                if (type === 'all') {
                    card.style.display = '';
                } else {
                    card.style.display = card.dataset.status === type ? '' : 'none';
                }
            });
        }
    </script>
@endpush