@extends('layouts.app-admin')
@section('title', 'Dashboard Admin')
@php $pageTitle = 'Dashboard Admin'; @endphp

@push('styles')
    <style>
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            padding: 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .stat-val {
            font-family: var(--font-main);
            font-size: 1.9rem;
            font-weight: 800;
            line-height: 1;
        }

        .stat-lbl {
            font-size: 0.76rem;
            color: var(--gray);
            margin-top: 4px;
        }

        .stat-sub {
            font-size: 0.72rem;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 28px;
        }

        .chart-card {
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            padding: 20px;
        }

        .chart-title {
            font-weight: 800;
            font-size: .9rem;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .table-card {
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .table-head {
            padding: 14px 18px;
            border-bottom: 1px solid var(--gray-mid);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-head h4 {
            font-weight: 800;
            font-size: .88rem;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: var(--gray-light);
            padding: 10px 14px;
            font-size: .75rem;
            font-weight: 700;
            text-align: left;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .data-table td {
            padding: 11px 14px;
            font-size: .83rem;
            border-bottom: 1px solid var(--gray-light);
            vertical-align: middle;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover td {
            background: var(--gray-light);
        }

        .badge-role {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: .7rem;
            font-weight: 700;
        }

        @media(max-width:1100px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- STAT CARDS --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff3f3; color:var(--red);"><i class="fa-solid fa-user-graduate"></i>
            </div>
            <div>
                <div class="stat-val">{{ $totalSiswa }}</div>
                <div class="stat-lbl">Total Siswa</div>
                <div class="stat-sub text-gray"><i class="fa-solid fa-circle" style="font-size:.4rem;color:var(--red);"></i>
                    Terdaftar aktif</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff8ec; color:var(--yellow);"><i
                    class="fa-solid fa-chalkboard-teacher"></i></div>
            <div>
                <div class="stat-val">{{ $totalGuru }}</div>
                <div class="stat-lbl">Total Guru</div>
                <div class="stat-sub text-gray"><i class="fa-solid fa-circle"
                        style="font-size:.4rem;color:var(--yellow);"></i> Pembimbing aktif</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4; color:#16a34a;"><i class="fa-solid fa-trophy"></i></div>
            <div>
                <div class="stat-val">{{ $totalLomba }}</div>
                <div class="stat-lbl">Total Lomba</div>
                <div class="stat-sub" style="color:#16a34a;"><i class="fa-solid fa-circle" style="font-size:.4rem;"></i>
                    {{ $lombaAktif }} aktif</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#eff6ff; color:#2563eb;"><i class="fa-solid fa-list-check"></i></div>
            <div>
                <div class="stat-val">{{ $totalPart }}</div>
                <div class="stat-lbl">Total Partisipasi</div>
                <div class="stat-sub" style="color:#2563eb;"><i class="fa-solid fa-medal" style="font-size:.7rem;"></i>
                    {{ $totalJuara }} juara</div>
            </div>
        </div>
    </div>

    @if($pendingMentor > 0)
        <div class="alert alert-warning" style="margin-bottom:20px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Ada <strong>{{ $pendingMentor }}</strong> permintaan guru pembimbing yang belum ditanggapi.
        </div>
    @endif

    {{-- CHARTS --}}
    <div class="chart-grid">
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-bar text-red"></i> Partisipasi 6 Bulan Terakhir</div>
            <canvas id="chartMonthly" height="100"></canvas>
        </div>
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-pie text-red"></i> Lomba per Level</div>
            <canvas id="chartLevel" height="100"></canvas>
        </div>
    </div>

    {{-- TABEL BAWAH --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:28px;">

        {{-- Siswa Terbaru --}}
        <div class="table-card">
            <div class="table-head">
                <h4><i class="fa-solid fa-user-graduate text-red"></i> Siswa Terbaru</h4>
                <a href="{{ route('admin.users.index', ['role' => 'student']) }}" class="btn btn-sm btn-secondary">Lihat
                    Semua</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentStudents as $s)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <div class="lb-avatar" style="width:30px;height:30px;font-size:.7rem;">
                                        {{ strtoupper(substr($s->name, 0, 2)) }}</div>
                                    <div>
                                        <div style="font-weight:700;">{{ $s->name }}</div>
                                        <div style="font-size:.72rem;color:var(--gray);">{{ $s->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $s->studentProfile->jurusan ?? '-' }} {{ $s->studentProfile->kelas ?? '' }}</td>
                            <td>
                                @if($s->is_active)
                                    <span class="badge-role" style="background:#d4edda;color:#155724;"><i class="fa-solid fa-circle"
                                            style="font-size:.4rem;"></i> Aktif</span>
                                @else
                                    <span class="badge-role" style="background:#f8d7da;color:#721c24;"><i class="fa-solid fa-circle"
                                            style="font-size:.4rem;"></i> Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Partisipasi Terbaru --}}
        <div class="table-card">
            <div class="table-head">
                <h4><i class="fa-solid fa-list-check text-red"></i> Partisipasi Terbaru</h4>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>Lomba</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentPart as $p)
                        @php
                            $stMap = ['registered' => ['Daftar', '#d1ecf1', '#0c5460'], 'in_progress' => ['Proses', '#fff3cd', '#856404'], 'completed' => ['Selesai', '#d4edda', '#155724'], 'submitted' => ['Submit', '#cce5ff', '#004085'], 'not_submitted' => ['Tdk Submit', '#f8d7da', '#721c24']];
                            $st = $stMap[$p->status] ?? [$p->status, '#eee', '#333'];
                        @endphp
                        <tr>
                            <td style="font-weight:600;">{{ Str::limit($p->user->name ?? '-', 16) }}</td>
                            <td style="font-size:.78rem;">{{ Str::limit($p->competition->title ?? '-', 24) }}</td>
                            <td><span class="badge-role" style="background:{{ $st[1] }};color:{{ $st[2] }};">{{ $st[0] }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Trending Competitions --}}
    <div class="table-card">
        <div class="table-head">
            <h4><i class="fa-solid fa-fire text-red"></i> Lomba Paling Banyak Dilihat</h4>
            <a href="{{ route('admin.competitions.index') }}" class="btn btn-sm btn-secondary">Kelola Lomba</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul Lomba</th>
                    <th>Level</th>
                    <th>Tipe</th>
                    <th>Deadline</th>
                    <th>Views</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trendingComps as $c)
                    @php
                        $lvl = ['nasional' => ['Nasional', 'level-nasional'], 'provinsi' => ['Provinsi', 'level-provinsi'], 'kota' => ['Kota', 'level-kota'], 'internasional' => ['Internasional', 'level-internasional'], 'sekolah' => ['Sekolah', 'level-sekolah']];
                        $l = $lvl[$c->level] ?? [$c->level, ''];
                    @endphp
                    <tr>
                        <td>
                            <div style="font-weight:700;">{{ Str::limit($c->title, 40) }}</div>
                            <div style="font-size:.72rem;color:var(--gray);">{{ $c->organizer }}</div>
                        </td>
                        <td><span class="comp-tag {{ $l[1] }}">{{ $l[0] }}</span></td>
                        <td><span
                                class="comp-tag {{ $c->type === 'team' ? 'type-team' : 'type-solo' }}">{{ $c->type === 'team' ? 'Tim' : 'Solo' }}</span>
                        </td>
                        <td style="font-size:.8rem;">{{ $c->deadline->format('d M Y') }}</td>
                        <td style="font-weight:700;color:var(--red);">{{ number_format($c->view_count) }}</td>
                        <td>
                            @if($c->is_active)
                                <span class="badge-role" style="background:#d4edda;color:#155724;">Aktif</span>
                            @else
                                <span class="badge-role" style="background:#f8d7da;color:#721c24;">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('scripts')
    <script>
        // Chart: Partisipasi Bulanan
        new Chart(document.getElementById('chartMonthly'), {
            type: 'bar',
            data: {
                labels: @json(collect($monthlyPart)->pluck('label')),
                datasets: [{
                    label: 'Partisipasi',
                    data: @json(collect($monthlyPart)->pluck('count')),
                    backgroundColor: 'rgba(227,30,37,0.8)',
                    borderRadius: 6,
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
        });

        // Chart: Level
        const levelData = @json($levelStats);
        new Chart(document.getElementById('chartLevel'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(levelData).map(k => k.charAt(0).toUpperCase() + k.slice(1)),
                datasets: [{
                    data: Object.values(levelData),
                    backgroundColor: ['#e31e25', '#f5a623', '#16a34a', '#2563eb', '#7c3aed'],
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: { plugins: { legend: { position: 'right', labels: { font: { size: 12 } } } }, cutout: '60%' }
        });
    </script>
@endpush