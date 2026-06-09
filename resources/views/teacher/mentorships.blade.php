@extends('layouts.app-teacher')
@section('title', 'Kelola Bimbingan')
@php $pageTitle = 'Kelola Bimbingan'; @endphp

@push('styles')
    <style>
        .tab-bar {
            display: flex;
            gap: 4px;
            background: var(--gray-light);
            border-radius: 10px;
            padding: 4px;
            margin-bottom: 20px;
        }

        .tab-btn {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 8px;
            font-size: .83rem;
            font-weight: 600;
            cursor: pointer;
            background: transparent;
            color: var(--gray);
            transition: all .2s;
        }

        .tab-btn.active {
            background: var(--white);
            color: var(--red);
            box-shadow: 0 1px 4px rgba(0, 0, 0, .08);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .mentor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 14px;
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
        }

        .wa-btn:hover {
            opacity: .88;
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h1><i class="fa-solid fa-user-tie text-red"></i> Kelola Bimbingan</h1>
        <p>Terima, tolak, dan pantau perkembangan siswa yang kamu bimbing</p>
    </div>

    <div class="tab-bar">
        <button class="tab-btn active" onclick="switchTab('pending',this)">
            <i class="fa-solid fa-clock"></i> Menunggu
            @if($pending->count() > 0)
                <span
                    style="background:var(--red);color:#fff;font-size:.62rem;padding:1px 6px;border-radius:10px;margin-left:4px;">{{ $pending->count() }}</span>
            @endif
        </button>
        <button class="tab-btn" onclick="switchTab('active',this)">
            <i class="fa-solid fa-person-running"></i> Aktif ({{ $accepted->count() }})
        </button>
        <button class="tab-btn" onclick="switchTab('history',this)">
            <i class="fa-solid fa-clock-rotate-left"></i> Riwayat ({{ $rejected->count() }})
        </button>
    </div>

    {{-- TAB: Pending --}}
    <div class="tab-content active" id="tab-pending">
        @if($pending->count() === 0)
            <div class="empty-state"><i class="fa-solid fa-inbox"></i>
                <h3>Tidak ada permintaan</h3>
                <p>Belum ada siswa yang meminta bimbingan</p>
            </div>
        @else
            <div class="mentor-grid">
                @foreach($pending as $m)
                    @php $siswa = $m->participation->user;
                    $comp = $m->participation->competition; @endphp
                    <div class="mentor-card"
                        style="background:var(--white);border:1.5px solid #ffeeba;border-radius:var(--radius);padding:18px;">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                            <div class="mc-avatar"
                                style="width:42px;height:42px;border-radius:10px;background:linear-gradient(135deg,var(--red),var(--yellow));display:flex;align-items:center;justify-content:center;color:#fff;font-size:.82rem;font-weight:700;">
                                {{ strtoupper(substr($siswa->name, 0, 2)) }}</div>
                            <div>
                                <div style="font-weight:700;">{{ $siswa->name }}</div>
                                <div style="font-size:.74rem;color:var(--gray);">{{ $siswa->studentProfile->kelas ?? '' }}
                                    {{ $siswa->studentProfile->jurusan ?? '' }}</div>
                            </div>
                        </div>
                        <div style="font-size:.82rem;margin-bottom:4px;font-weight:600;"><i class="fa-solid fa-trophy text-red"></i>
                            {{ Str::limit($comp->title, 48) }}</div>
                        <div style="font-size:.75rem;color:var(--gray);margin-bottom:12px;">{{ $comp->organizer }} &bull; Deadline
                            {{ $comp->deadline->format('d M Y') }}</div>
                        <div style="font-size:.75rem;color:var(--gray);margin-bottom:12px;">
                            <i class="fa-solid fa-calendar"></i> Diminta {{ $m->created_at->diffForHumans() }}
                        </div>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <form method="POST" action="{{ route('teacher.mentorships.respond', $m) }}">
                                @csrf <input type="hidden" name="action" value="accept">
                                <button type="submit" class="btn btn-sm" style="background:#d4edda;color:#155724;">
                                    <i class="fa-solid fa-check"></i> Terima
                                </button>
                            </form>
                            <form method="POST" action="{{ route('teacher.mentorships.respond', $m) }}">
                                @csrf <input type="hidden" name="action" value="reject">
                                <button type="submit" class="btn btn-sm" style="background:#f8d7da;color:#721c24;">
                                    <i class="fa-solid fa-xmark"></i> Tolak
                                </button>
                            </form>
                            @if($siswa->wa_number)
                                <a href="https://wa.me/{{ $siswa->wa_number }}?text={{ urlencode('Halo ' . $siswa->name . ', saya ' . $m->teacher->name . ' akan segera merespons permintaan bimbingan lomba "' . $comp->title . '".') }}"
                                    target="_blank" class="wa-btn">
                                    <i class="fa-brands fa-whatsapp"></i> WA Siswa
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- TAB: Aktif --}}
    <div class="tab-content" id="tab-active">
        @if($accepted->count() === 0)
            <div class="empty-state"><i class="fa-solid fa-users"></i>
                <h3>Belum ada bimbingan aktif</h3>
            </div>
        @else
            <div class="mentor-grid">
                @foreach($accepted as $m)
                    @php
                        $siswa = $m->participation->user;
                        $comp = $m->participation->competition;
                        $steps = $m->participation->steps;
                        $done = $steps->where('is_confirmed', true)->count();
                        $total = $steps->count();
                        $pct = $total > 0 ? round($done / $total * 100) : 0;
                        $statusMap = ['registered' => ['Terdaftar', '#d1ecf1', '#0c5460'], 'in_progress' => ['Sedang Proses', '#fff3cd', '#856404'], 'submitted' => ['Submit', '#cce5ff', '#004085'], 'completed' => ['Selesai', '#d4edda', '#155724'], 'not_submitted' => ['Tidak Submit', '#f8d7da', '#721c24']];
                        $st = $statusMap[$m->participation->status] ?? [$m->participation->status, '#eee', '#333'];
                        $resultMap = ['juara_1' => '🥇 Juara 1', 'juara_2' => '🥈 Juara 2', 'juara_3' => '🥉 Juara 3', 'juara_harapan' => 'Juara Harapan', 'tidak_lolos' => 'Tidak Lolos', 'belum_diisi' => 'Belum Diisi'];
                    @endphp
                    <div
                        style="background:var(--white);border:1.5px solid var(--gray-mid);border-radius:var(--radius);padding:18px;">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                            <div
                                style="width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,var(--red),var(--yellow));display:flex;align-items:center;justify-content:center;color:#fff;font-size:.8rem;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($siswa->name, 0, 2)) }}</div>
                            <div style="flex:1;">
                                <div style="font-weight:700;font-size:.86rem;">{{ $siswa->name }}</div>
                                <div style="font-size:.73rem;color:var(--gray);">{{ $siswa->studentProfile->jurusan ?? '' }}</div>
                            </div>
                            <span
                                style="font-size:.7rem;font-weight:700;padding:3px 8px;border-radius:20px;background:{{ $st[1] }};color:{{ $st[2] }};">{{ $st[0] }}</span>
                        </div>
                        <div style="font-size:.8rem;font-weight:700;margin-bottom:3px;"><i class="fa-solid fa-trophy text-red"></i>
                            {{ Str::limit($comp->title, 45) }}</div>
                        <div style="font-size:.73rem;color:var(--gray);margin-bottom:10px;">Deadline:
                            {{ $comp->deadline->format('d M Y') }}</div>

                        @if($m->participation->result !== 'belum_diisi')
                            <div
                                style="font-size:.78rem;margin-bottom:8px;padding:6px 10px;background:var(--yellow-light);border-radius:8px;font-weight:700;">
                                <i class="fa-solid fa-medal" style="color:var(--yellow);"></i>
                                Hasil: {{ $resultMap[$m->participation->result] ?? $m->participation->result }}
                            </div>
                        @endif

                        @if($total > 0)
                            <div style="margin-bottom:10px;">
                                <div
                                    style="display:flex;justify-content:space-between;font-size:.7rem;color:var(--gray);margin-bottom:3px;">
                                    <span>Progres</span><span>{{ $pct }}%</span>
                                </div>
                                <div style="background:var(--gray-mid);border-radius:10px;height:5px;">
                                    <div style="background:var(--red);height:5px;border-radius:10px;width:{{ $pct }}%;"></div>
                                </div>
                            </div>
                        @endif

                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('teacher.mentorships.show', $m) }}" class="btn btn-sm btn-secondary">
                                <i class="fa-solid fa-eye"></i> Detail
                            </a>
                            @if($siswa->wa_number)
                                <a href="https://wa.me/{{ $siswa->wa_number }}?text={{ urlencode('Halo ' . $siswa->name . ', bagaimana perkembangan lomba "' . $comp->title . '" kamu?') }}"
                                    target="_blank" class="wa-btn">
                                    <i class="fa-brands fa-whatsapp"></i> WA
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- TAB: Riwayat --}}
    <div class="tab-content" id="tab-history">
        @if($rejected->count() === 0)
            <div class="empty-state"><i class="fa-solid fa-clock-rotate-left"></i>
                <h3>Belum ada riwayat</h3>
            </div>
        @else
            <div class="table-card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Lomba</th>
                            <th>Status</th>
                            <th>Ditolak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rejected as $m)
                            <tr>
                                <td style="font-weight:700;">{{ $m->participation->user->name ?? '-' }}</td>
                                <td style="font-size:.8rem;">{{ Str::limit($m->participation->competition->title ?? '-', 40) }}</td>
                                <td><span
                                        style="font-size:.72rem;font-weight:700;padding:3px 8px;border-radius:20px;background:#f8d7da;color:#721c24;">Ditolak</span>
                                </td>
                                <td style="font-size:.78rem;color:var(--gray);">
                                    {{ $m->responded_at ? $m->responded_at->diffForHumans() : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection

@push('scripts')
    <script>
        function switchTab(name, btn) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + name).classList.add('active');
            btn.classList.add('active');
        }
    </script>
@endpush