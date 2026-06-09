@extends('layouts.app-student')
@section('title', 'Rekapitulasi')
@php $pageTitle = 'Rekapitulasi Prestasi'; @endphp

@push('styles')
    <style>
        .recap-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .recap-chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        .chart-card {
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            padding: 20px;
        }

        .chart-card h4 {
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .ai-summary-card {
            background: linear-gradient(135deg, #1a1a2e, #2d2d3a);
            border-radius: var(--radius);
            padding: 24px;
            margin-bottom: 24px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .ai-summary-card::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 160px;
            height: 160px;
            background: rgba(227, 30, 37, 0.15);
            border-radius: 50%;
        }

        .ai-summary-card h4 {
            font-size: 0.9rem;
            opacity: 0.7;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ai-summary-card .ai-text {
            font-size: 0.92rem;
            line-height: 1.8;
            font-style: italic;
            opacity: 0.95;
        }

        .ai-summary-card .ai-loading {
            display: flex;
            align-items: center;
            gap: 10px;
            opacity: 0.7;
            font-size: 0.85rem;
        }

        .best-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-bottom: 1px solid var(--gray-light);
        }

        .best-row:last-child {
            border-bottom: none;
        }

        @media(max-width:900px) {
            .recap-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .recap-chart-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    <div class="page-header">
        <h1><i class="fa-solid fa-chart-pie text-red"></i> Rekapitulasi Prestasi</h1>
        <p>Pantau semua aktivitas dan prestasimu dalam satu halaman</p>
    </div>

    {{-- Stat Cards --}}
    <div class="recap-stats">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff3f3;color:var(--red);"><i class="fa-solid fa-list-check"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Lomba Diikuti</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff8ec;color:var(--yellow);"><i class="fa-solid fa-trophy"></i></div>
            <div>
                <div class="stat-value">{{ $stats['win'] }}</div>
                <div class="stat-label">Kali Meraih Juara</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#d4edda;color:#155724;"><i class="fa-solid fa-paper-plane"></i></div>
            <div>
                <div class="stat-value">{{ $stats['submitted'] }}</div>
                <div class="stat-label">Berhasil Submit</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:var(--gray-light);color:var(--gray);"><i
                    class="fa-solid fa-flag-checkered"></i></div>
            <div>
                <div class="stat-value">{{ $stats['completed'] }}</div>
                <div class="stat-label">Lomba Selesai</div>
            </div>
        </div>
    </div>

    {{-- AI Summary --}}
    <div class="ai-summary-card">
        <h4><i class="fa-solid fa-wand-magic-sparkles" style="color:var(--yellow);"></i> Rangkuman AI untuk Kamu</h4>
        <div class="ai-text" id="aiSummaryText">
            <div class="ai-loading" id="aiLoading">
                <div class="spinner" style="border-color:rgba(255,255,255,0.3); border-top-color:#fff;"></div>
                <span>AI sedang menganalisis prestasi kamu...</span>
            </div>
        </div>
        <button class="btn btn-sm"
            style="margin-top:14px; background:rgba(255,255,255,0.15); color:#fff; border:1px solid rgba(255,255,255,0.3);"
            onclick="loadAiSummary()">
            <i class="fa-solid fa-rotate"></i> Refresh Rangkuman
        </button>
    </div>

    {{-- Charts --}}
    <div class="recap-chart-grid">
        <div class="chart-card">
            <h4><i class="fa-solid fa-chart-line text-red"></i> Aktivitas Lomba 12 Bulan Terakhir</h4>
            <canvas id="chartMonthly" height="100"></canvas>
        </div>
        <div class="chart-card">
            <h4><i class="fa-solid fa-chart-pie text-red"></i> Distribusi Kategori</h4>
            <canvas id="chartCategory" height="180"></canvas>
        </div>
    </div>

    {{-- Best Results --}}
    @if($bestResults->count())
        <div class="chart-card" style="margin-bottom:24px;">
            <h4><i class="fa-solid fa-medal text-yellow"></i> Pencapaian Terbaik</h4>
            @foreach($bestResults as $part)
                @php
                    $res = ['juara_1' => ['Juara 1', 'fa-crown', '#f5a623'], 'juara_2' => ['Juara 2', 'fa-medal', '#9e9e9e'], 'juara_3' => ['Juara 3', 'fa-award', '#8d6e63'], 'juara_harapan' => ['Harapan', 'fa-star-half', '#f5a623'], 'favorit' => ['Favorit', 'fa-heart', 'var(--red)'], 'terpilih' => ['Terpilih', 'fa-check-circle', '#28a745']];
                    $r = $res[$part->result] ?? ['Prestasi', 'fa-star', 'var(--gray)'];
                @endphp
                <div class="best-row">
                    <i class="fa-solid {{ $r[1] }}" style="color:{{ $r[2] }}; font-size:1.2rem; width:24px;"></i>
                    <div style="flex:1;">
                        <div style="font-weight:700; font-size:0.85rem;">{{ $part->competition->title }}</div>
                        <div style="font-size:0.75rem; color:var(--gray);">{{ $part->competition->organizer }}</div>
                    </div>
                    <span class="comp-tag" style="background:{{ $r[2] }}22; color:{{ $r[2] }}; font-weight:700;">
                        {{ $r[0] }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Tabel semua lomba --}}
    <div class="chart-card">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;">
            <h4 style="margin-bottom:0;"><i class="fa-solid fa-table text-red"></i> Riwayat Lengkap</h4>
            <button class="btn btn-secondary btn-sm" onclick="window.print()">
                <i class="fa-solid fa-print"></i> Cetak
            </button>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; font-size:0.82rem;">
                <thead>
                    <tr style="background:var(--bg);">
                        <th
                            style="padding:10px 12px; text-align:left; font-weight:700; border-bottom:2px solid var(--gray-mid);">
                            Lomba</th>
                        <th
                            style="padding:10px 12px; text-align:left; font-weight:700; border-bottom:2px solid var(--gray-mid);">
                            Level</th>
                        <th
                            style="padding:10px 12px; text-align:left; font-weight:700; border-bottom:2px solid var(--gray-mid);">
                            Status</th>
                        <th
                            style="padding:10px 12px; text-align:left; font-weight:700; border-bottom:2px solid var(--gray-mid);">
                            Hasil</th>
                        <th
                            style="padding:10px 12px; text-align:left; font-weight:700; border-bottom:2px solid var(--gray-mid);">
                            Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participations as $part)
                        <tr style="border-bottom:1px solid var(--gray-light);">
                            <td style="padding:10px 12px;">
                                <div style="font-weight:600;">{{ Str::limit($part->competition->title, 40) }}</div>
                                <div style="font-size:0.72rem; color:var(--gray);">{{ $part->competition->organizer }}</div>
                            </td>
                            <td style="padding:10px 12px;">
                                <span class="comp-tag level-{{ $part->competition->level }}" style="font-size:0.7rem;">
                                    {{ ucfirst($part->competition->level) }}
                                </span>
                            </td>
                            <td style="padding:10px 12px;">{{ ucfirst(str_replace('_', ' ', $part->status)) }}</td>
                            <td style="padding:10px 12px; font-weight:600; color:var(--red);">
                                {{ ucfirst(str_replace('_', ' ', $part->result)) }}
                            </td>
                            <td style="padding:10px 12px; color:var(--gray);">{{ $part->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:24px; text-align:center; color:var(--gray);">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Monthly Chart
        const monthlyCtx = document.getElementById('chartMonthly').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                // Hapus tanda kurung () setelah variabel
                labels: @json(array_keys($byMonth)),
                datasets: [{
                    label: 'Lomba Diikuti',
                    // Hapus tanda kurung () setelah variabel
                    data: @json(array_values($byMonth)),
                    backgroundColor: 'rgba(227,30,37,0.15)',
                    borderColor: '#e31e25',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f1f3' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Category Chart
        const catCtx = document.getElementById('chartCategory').getContext('2d');
        // Hapus tanda kurung ekstra di akhir
        const catLabels = @json($byCategory->keys());
        const catData = @json($byCategory->values());
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: catLabels,
                datasets: [{
                    data: catData,
                    backgroundColor: ['#e31e25', '#f5a623', '#6c757d', '#28a745', '#17a2b8', '#6f42c1'],
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom', labels: { font: { size: 11 }, padding: 12 } } },
                cutout: '60%',
            }
        });

        // AI Summary
        function loadAiSummary() {
            document.getElementById('aiSummaryText').innerHTML =
                '<div class="ai-loading"><div class="spinner" style="border-color:rgba(255,255,255,0.3);border-top-color:#fff;"></div><span>AI sedang menganalisis...</span></div>';

            fetch('{{ route("student.recapitulation.summarize") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
                .then(r => r.json())
                .then(data => {
                    document.getElementById('aiSummaryText').textContent = data.summary;
                });
        }

        document.addEventListener('DOMContentLoaded', loadAiSummary);
    </script>
@endpush