@extends('layouts.app-student')
@section('title', 'Eksplor')
@php $pageTitle = 'Eksplor'; @endphp

@push('styles')
    <style>
        /* ===== UTILITIES & RESET ===== */
        :root {
            --surface-card: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        /* ===== EXPLORER INTERFACE STRUCTURE ===== */
        .explorer-wrap {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 24px;
            height: calc(100vh - var(--navbar-h) - 160px);
            min-height: 650px;
            margin-top: 16px;
        }

        /* ===== LEFT PANEL: CONTENT LIST ===== */
        .explorer-left {
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        /* Advanced Filter Controls Container */
        .filter-container {
            background: var(--surface-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .filter-row-top {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 14px;
        }

        .search-box {
            position: relative;
            flex: 1;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .search-box input {
            width: 100%;
            padding: 10px 14px 10px 40px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            font-size: 0.85rem;
            transition: all var(--transition);
            background-color: #f8fafc;
        }

        .search-box input:focus {
            background-color: #fff;
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(227, 30, 37, 0.1);
            outline: none;
        }

        .filter-select-group {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .filter-select {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            font-size: 0.8rem;
            color: var(--text-main);
            background-color: #fff;
            cursor: pointer;
            outline: none;
            transition: border var(--transition);
        }

        .filter-select:focus {
            border-color: var(--red);
        }

        .filter-tabs {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
            margin-bottom: 12px;
            scrollbar-width: none;
        }

        .filter-tabs::-webkit-scrollbar {
            display: none;
        }

        .tab-chip {
            padding: 8px 16px;
            border-radius: 20px;
            background: #f1f5f9;
            border: 1px solid transparent;
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 600;
            white-space: nowrap;
            cursor: pointer;
            transition: all var(--transition);
        }

        .tab-chip:hover {
            background: #e2e8f0;
            color: var(--text-main);
        }

        .tab-chip.active {
            background: rgba(227, 30, 37, 0.08);
            border-color: rgba(227, 30, 37, 0.2);
            color: var(--red);
        }

        /* Scroll Area Grid */
        .explorer-grid-scroll {
            flex: 1;
            overflow-y: auto;
            padding-right: 4px;
        }

        .explorer-bento {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        /* Clean Premium Cards */
        .eb-card {
            background: var(--surface-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            display: flex;
            flex-direction: column;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
        }

        .eb-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            border-color: rgba(227, 30, 37, 0.3);
        }

        .eb-card.active {
            border-color: var(--red);
            box-shadow: 0 0 0 4px rgba(227, 30, 37, 0.08);
            background: #fffcfc;
        }

        .eb-image-wrapper {
            position: relative;
            width: 100%;
            height: 130px;
            background: #f8fafc;
            overflow: hidden;
        }

        .eb-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition);
        }

        .eb-card:hover .eb-cover {
            transform: scale(1.04);
        }

        .eb-cover-ph {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc, #edf2f7);
            color: #cbd5e1;
            font-size: 2rem;
        }

        .eb-badges-top {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            pointer-events: none;
        }

        .badge-ui {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 30px;
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .badge-ui.trend { background: rgba(227, 30, 37, 0.9); color: #fff; }
        .badge-ui.save { background: rgba(245, 158, 11, 0.9); color: #fff; }

        .eb-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .eb-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.4;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.8em;
        }

        .eb-org {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .eb-meta {
            margin-top: auto;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .eb-tag {
            font-size: 0.68rem;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .tag-deadline { background: #fef2f2; color: #ef4444; }
        .tag-type { background: #f0fdf4; color: #22c55e; }

        /* ===== RIGHT PANEL: DETAIL APPLICATION CONTAINER ===== */
        .explorer-right {
            display: flex;
            flex-direction: column;
            background: var(--surface-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 2px 4px -1px rgba(0,0,0,0.01);
        }

        .er-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fafafa;
        }

        .er-header h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .er-nav {
            display: flex;
            gap: 6px;
        }

        .er-nav-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: all var(--transition);
        }

        .er-nav-btn:hover {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
        }

        .er-body {
            flex: 1;
            overflow-y: auto;
        }

        /* Detail Panel Presentation View Styling */
        .er-poster {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .er-poster-ph {
            width: 100%;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            color: var(--text-muted);
            font-size: 3rem;
        }

        .er-content {
            padding: 24px;
        }

        .er-cat {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 30px;
            margin-bottom: 14px;
        }

        .er-title {
            font-size: 1.2rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .er-organizer {
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .er-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 16px;
        }

        .comp-tag {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .level-nasional { background: #eff6ff; color: #2563eb; }
        .level-internasional { background: #faf5ff; color: #8b5cf6; }
        .level-provinsi { background: #fff7ed; color: #ea580c; }
        .level-kota { background: #f0fdfa; color: #0d9488; }

        .er-info-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .er-info-row {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.82rem;
        }

        .er-info-row i {
            width: 20px;
            color: var(--red);
            font-size: 0.95rem;
            text-align: center;
        }

        .er-info-label {
            color: var(--text-muted);
            width: 110px;
            font-size: 0.8rem;
        }

        .er-info-value {
            color: var(--text-main);
            font-weight: 600;
            flex: 1;
        }

        .er-section-title {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text-main);
            margin: 20px 0 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .er-desc {
            font-size: 0.85rem;
            color: #334155;
            line-height: 1.6;
        }

        .er-stages {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        .er-stage-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 12px;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
        }

        .er-stage-num {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--red);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .er-footer {
            padding: 16px 20px;
            border-top: 1px solid var(--border-color);
            background: #fafafa;
            display: flex;
            gap: 10px;
        }

        /* ===== LOADING SKELETON SHIMMER EFFECT ===== */
        .skeleton {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite linear;
            border-radius: 8px;
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ===== RESPONSIVE DESIGN BREAKPOINTS ===== */
        @media(max-width: 1200px) {
            .explorer-bento { grid-template-columns: repeat(2, 1fr); }
        }

        @media(max-width: 992px) {
            .explorer-wrap { grid-template-columns: 1fr; height: auto; }
            .explorer-right { min-height: 550px; }
            .filter-select-group { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
@endpush

@section('content')

    <div class="page-header" style="margin-bottom: 20px;">
        <h1 style="font-size: 1.5rem; font-weight: 800; color: #0f172a;">
            <i class="fa-solid fa-compass text-red" style="margin-right: 6px;"></i> Eksplorasi Kompetisi
        </h1>
        <p style="color: var(--text-muted); font-size: 0.88rem; margin-top: 4px;">Temukan wadah kompetisi terbaik yang selaras dengan kapabilitas bakatmu.</p>
    </div>

    {{-- ADVANCED SEARCH & FILTERS BAR CONTROLLER --}}
    <div class="filter-container">
        <div class="filter-row-top">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Ketik tajuk kompetisi yang dicari..." value="{{ request('search') }}" oninput="debounceFilter()">
            </div>
        </div>

        {{-- Filter Tab Chips Quick Filter --}}
        <div class="filter-tabs">
            <button class="tab-chip {{ !request('filter') ? 'active' : '' }}" onclick="setFilter('')">Semua Lomba</button>
            <button class="tab-chip {{ request('filter') === 'trending' ? 'active' : '' }}" onclick="setFilter('trending')">
                <i class="fa-solid fa-fire" style="margin-right:4px;"></i> Populer / Tren
            </button>
            <button class="tab-chip {{ request('filter') === 'terbaru' ? 'active' : '' }}" onclick="setFilter('terbaru')">
                <i class="fa-solid fa-clock" style="margin-right:4px;"></i> Rilis Terbaru
            </button>
            <button class="tab-chip {{ request('filter') === 'nasional' ? 'active' : '' }}" onclick="setFilter('nasional')">
                <i class="fa-solid fa-flag" style="margin-right:4px;"></i> Skala Nasional
            </button>
            <button class="tab-chip {{ request('filter') === 'deadline' ? 'active' : '' }}" onclick="setFilter('deadline')">
                <i class="fa-solid fa-hourglass-end" style="margin-right:4px;"></i> Batas Waktu Terdekat
            </button>
        </div>

        {{-- Row Filter Selectors Group (Category & Fields Included) --}}
        <div class="filter-select-group">
            <select class="filter-select" onchange="setCategory(this.value)">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select class="filter-select" onchange="setField(this.value)">
                <option value="">Semua Bidang</option>
                @foreach($fields as $fld)
                    <option value="{{ $fld->id }}" {{ request('field') == $fld->id ? 'selected' : '' }}>{{ $fld->name }}</option>
                @endforeach
            </select>

            <select class="filter-select" onchange="setLevel(this.value)">
                <option value="">Semua Cakupan Tingkat</option>
                <option value="kota" {{ request('level') === 'kota' ? 'selected' : '' }}>Kota / Kabupaten</option>
                <option value="provinsi" {{ request('level') === 'provinsi' ? 'selected' : '' }}>Provinsi Wilayah</option>
                <option value="nasional" {{ request('level') === 'nasional' ? 'selected' : '' }}>Nasional Negara</option>
                <option value="internasional" {{ request('level') === 'internasional' ? 'selected' : '' }}>Internasional Global</option>
            </select>

            <select class="filter-select" onchange="setType(this.value)">
                <option value="">Semua Tipe Partisipan</option>
                <option value="solo" {{ request('type') === 'solo' ? 'selected' : '' }}>Mandiri (Individu)</option>
                <option value="team" {{ request('type') === 'team' ? 'selected' : '' }}>Kelompok (Tim)</option>
            </select>
        </div>
    </div>

    {{-- MAIN CONTENT SPLIT LAYOUT WORKSPACE --}}
    <div class="explorer-wrap">
        
        {{-- LEFT SIDEBAR: BENTO CONTAINER LIST GRID --}}
        <div class="explorer-left">
            <div class="explorer-grid-scroll">
                @if($competitions->count())
                    <div class="explorer-bento" id="explorerBento">
                        @foreach($competitions as $comp)
                            @php
                                $isSaved = in_array($comp->id, $savedIds);
                                $deadlineSoon = $comp->deadline->diffInDays(now()) <= 7 && $comp->deadline->isFuture();
                            @endphp
                            
                            <div class="eb-card {{ isset($firstComp) && $firstComp->id === $comp->id ? 'active' : '' }}"
                                 id="ebc-{{ $comp->id }}" onclick="selectComp({{ $comp->id }}, this)">
                                
                                <div class="eb-image-wrapper">
                                    <div class="eb-badges-top">
                                        <div>
                                            @if($comp->is_trending)
                                                <span class="badge-ui trend"><i class="fa-solid fa-fire"></i> Populer</span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($isSaved)
                                                <span class="badge-ui save" id="cardBadgeSave-{{ $comp->id }}"><i class="fa-solid fa-bookmark"></i> Tersimpan</span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($comp->cover)
                                        <img class="eb-cover" src="{{ asset('storage/' . $comp->cover) }}" alt="{{ $comp->title }}"
                                             onerror="this.outerHTML='<div class=\'eb-cover-ph\'><i class=\'fa-solid fa-trophy\'></i></div>'">
                                    @else
                                        <div class="eb-cover-ph"><i class="fa-solid fa-trophy"></i></div>
                                    @endif
                                </div>

                                <div class="eb-body">
                                    <div class="eb-title">{{ $comp->title }}</div>
                                    <div class="eb-org"><i class="fa-solid fa-building-columns"></i> {{ Str::limit($comp->organizer, 34) }}</div>
                                    
                                    <div class="eb-meta">
                                        <span class="eb-tag tag-deadline">
                                            <i class="fa-solid fa-calendar-day"></i> {{ $comp->deadline->format('d M Y') }}
                                        </span>
                                        <span class="eb-tag tag-type">
                                            <i class="fa-solid {{ $comp->type === 'team' ? 'fa-users' : 'fa-user' }}"></i>
                                            {{ $comp->type === 'team' ? 'Tim' : 'Solo' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center" style="padding: 60px 20px; background:#fff; border-radius:12px; border:1px solid var(--border-color);">
                        <i class="fa-solid fa-folder-open" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 16px; display:block;"></i>
                        <h3 style="font-size:1rem; font-weight:700; color:var(--text-main);">Tidak ada kompetisi ditemukan</h3>
                        <p style="color:var(--text-muted); font-size:0.82rem; margin-top:4px;">Cobalah untuk menyesuaikan preferensi atau kata kunci pencarian Anda.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- RIGHT PANEL: LIVE DETAIL MONITOR PRESENTATION PANEL --}}
        <div class="explorer-right" id="explorerRight">
            <div class="er-header">
                <h4><i class="fa-solid fa-file-invoice text-red" style="margin-right:4px;"></i> Rincian Lomba</h4>
                <div class="er-nav">
                    <button class="er-nav-btn" onclick="navComp(-1)" title="Kompetisi Sebelumnya">
                        <i class="fa-solid fa-chevron-up"></i>
                    </button>
                    <button class="er-nav-btn" onclick="navComp(1)" title="Kompetisi Berikutnya">
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div>
            </div>
            
            <div class="er-body" id="erBody">
                @if($firstComp)
                    @include('components.comp-detail', ['comp' => $firstComp, 'savedIds' => $savedIds, 'saveFolders' => $saveFolders])
                @else
                    <div class="text-center" style="margin-top: 100px; padding: 0 24px;">
                        <i class="fa-solid fa-hand-pointer style-muted" style="font-size: 3rem; color: #cbd5e1; margin-bottom:16px; display:block;"></i>
                        <h3 style="font-size:0.95rem; font-weight:700; color:var(--text-main);">Pilih Entitas Kompetisi</h3>
                        <p style="color:var(--text-muted); font-size:0.82rem; margin-top:4px;">Klik salah satu kartu di panel kiri untuk memuat spesifikasi data secara lengkap.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Data kompetisi terdaftar untuk navigasi indeks keyboard/panah panel kanan
        const compIds = @json($competitions->pluck('id')->values());
        let currentIndex = {{ isset($firstComp) ? $competitions->search(fn($c) => $c->id === $firstComp->id) : 0 }};
        let debounceTimer;

        /**
         * Mengambil data eksternal via AJAX dan merender ulang detail panel kanan
         */
        function selectComp(id, el) {
            document.querySelectorAll('.eb-card').forEach(c => c.classList.remove('active'));
            if (el) el.classList.add('active');
            currentIndex = compIds.indexOf(id);

            // Shimmer effect placeholder loading skeleton
            document.getElementById('erBody').innerHTML = `
                <div>
                    <div class="skeleton" style="height:220px; border-radius:0; margin-bottom:20px;"></div>
                    <div style="padding: 0 24px 24px;">
                        <div class="skeleton" style="height:24px; width:30%; margin-bottom:14px; border-radius:20px;"></div>
                        <div class="skeleton" style="height:28px; width:90%; margin-bottom:10px;"></div>
                        <div class="skeleton" style="height:18px; width:50%; margin-bottom:24px;"></div>
                        <div class="skeleton" style="height:100px; margin-bottom:20px; border-radius:12px;"></div>
                        <div class="skeleton" style="height:16px; width:100%; margin-bottom:8px;"></div>
                        <div class="skeleton" style="height:16px; width:85%;"></div>
                    </div>
                </div>`;

            fetch(`/student/explore/${id}/detail`)
                .then(r => {
                    if (!r.ok) throw new Error('Network error or structural invalid resource ID.');
                    return r.json();
                })
                .then(data => {
                    renderDetail(data);
                })
                .catch(err => {
                    document.getElementById('erBody').innerHTML = `
                        <div class="text-center" style="padding: 40px 20px; color: var(--red);">
                            <i class="fa-solid fa-circle-exclamation" style="font-size:2rem; margin-bottom:10px;"></i>
                            <p style="font-size:0.85rem; font-weight:600;">Gagal memuat detail data secara dinamis.</p>
                        </div>`;
                });
        }

        /**
         * Konstruksi & Transpilasi objek JSON Kompetisi ke dalam struktur DOM HTML Premium
         */
        function renderDetail(comp) {
            const savedArray = @json($savedIds);
            const isSaved = savedArray.includes(comp.id);
            
            const levelMap = { nasional: 'level-nasional', internasional: 'level-internasional', provinsi: 'level-provinsi', kota: 'level-kota' };
            const levelLabel = { nasional: 'Nasional Negara', internasional: 'Internasional Global', provinsi: 'Provinsi Wilayah', kota: 'Kota / Kabupaten' };

            let stagesHtml = '';
            if (comp.stages && comp.stages.length > 0) {
                stagesHtml = `
                    <div class="er-section-title"><i class="fa-solid fa-layer-group text-red"></i> Alur Struktural Tahapan</div>
                    <div class="er-stages">
                        ${comp.stages.map(s => `
                            <div class="er-stage-item">
                                <div class="er-stage-num">${s.stage_number}</div>
                                <div style="flex:1;">
                                    <div style="font-weight:700; font-size:0.85rem; color:var(--text-main);">${s.stage_name}</div>
                                    <div style="font-size:0.75rem; color:#ef4444; font-weight:600; margin-top:2px;">
                                        <i class="fa-solid fa-clock"></i> Tenggat: ${s.deadline ? s.deadline : 'Tidak ada batasan'}
                                    </div>
                                    ${s.description ? `<div style="font-size:0.8rem; color:var(--text-muted); margin-top:4px; line-height:1.4;">${s.description}</div>` : ''}
                                </div>
                            </div>
                        `).join('')}
                    </div>`;
            }

            const posterSrc = comp.cover ? `/storage/${comp.cover}` : null;

            let htmlResult = `
                ${posterSrc 
                    ? `<img class="er-poster" src="${posterSrc}" alt="${comp.title}" onerror="this.outerHTML='<div class=\\'er-poster-ph\\\'><i class=\\'fa-solid fa-trophy\\'></i></div>'">`
                    : `<div class="er-poster-ph"><i class="fa-solid fa-trophy"></i></div>`
                }

                <div class="er-content">
                    <div class="er-cat" style="background:${comp.category?.color || '#e31e25'}15; color:${comp.category?.color || '#e31e25'};">
                        <i class="fa-solid ${comp.category?.icon || 'fa-trophy'}"></i> ${comp.category?.name || 'Umum'}
                    </div>

                    <div class="er-title">${comp.title}</div>
                    <div class="er-organizer"><i class="fa-solid fa-building-columns"></i> Diadakan oleh: ${comp.organizer}</div>

                    <div class="er-tags">
                        <span class="comp-tag ${levelMap[comp.level] || 'level-kota'}">
                            <i class="fa-solid fa-globe"></i> ${levelLabel[comp.level] || comp.level}
                        </span>
                        <span class="comp-tag" style="background:#f1f5f9; color:#475569;">
                            <i class="fa-solid ${comp.type === 'team' ? 'fa-users' : 'fa-user'}"></i>
                            ${comp.type === 'team' ? `Kelompok (${comp.min_members}-${comp.max_members} Personil)` : 'Individu (Mandiri)'}
                        </span>
                    </div>

                    <div class="er-info-card">
                        <div class="er-info-row">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span class="er-info-label">Registrasi Ditutup</span>
                            <span class="er-info-value">${comp.register_deadline || 'Fleksibel'}</span>
                        </div>
                        <div class="er-info-row">
                            <i class="fa-solid fa-hourglass-half"></i>
                            <span class="er-info-label">Batas Pengumpulan</span>
                            <span class="er-info-value" style="color:#ef4444;">${comp.deadline || '-'}</span>
                        </div>
                        <div class="er-info-row">
                            <i class="fa-solid fa-bullhorn"></i>
                            <span class="er-info-label">Hari Pengumuman</span>
                            <span class="er-info-value">${comp.announcement_date || 'Menyusul'}</span>
                        </div>
                    </div>

                    ${(comp.link_registration || comp.guidebook_link) ? `
                        <div class="er-section-title"><i class="fa-solid fa-link text-red"></i> Tautan Kompetisi</div>
                        <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px;">
                            ${comp.link_registration ? `<a href="${comp.link_registration}" target="_blank" class="btn btn-outline-red btn-sm" style="min-width:150px; display:inline-flex; align-items:center; justify-content:center; gap:8px;"><i class="fa-solid fa-arrow-up-right-from-square"></i> Daftar</a>` : ''}
                            ${comp.guidebook_link ? `<a href="${comp.guidebook_link}" target="_blank" class="btn btn-secondary btn-sm" style="min-width:150px; display:inline-flex; align-items:center; justify-content:center; gap:8px;"><i class="fa-solid fa-book-open"></i> Guidebook</a>` : ''}
                        </div>
                    ` : ''}

                    ${comp.description ? `
                        <div class="er-section-title"><i class="fa-solid fa-align-left text-red"></i> Deskripsi Pengantar</div>
                        <div class="er-desc">${comp.description}</div>
                    ` : ''}

                    ${comp.requirements ? `
                        <div class="er-section-title"><i class="fa-solid fa-clipboard-list text-red"></i> Syarat & Ketentuan Kelayakan</div>
                        <div class="er-desc">${comp.requirements}</div>
                    ` : ''}

                    ${stagesHtml}
                </div>`;

                const linkButtons = [];
                if (comp.link_registration) {
                    linkButtons.push(`<a href="${comp.link_registration}" target="_blank" class="btn btn-outline-red" style="font-weight:700; min-width:150px; display:inline-flex; align-items:center; justify-content:center; gap:8px;"><i class="fa-solid fa-arrow-up-right-from-square"></i> Daftar Sekarang</a>`);
                }
                if (comp.guidebook_link) {
                    linkButtons.push(`<a href="${comp.guidebook_link}" target="_blank" class="btn btn-secondary" style="font-weight:700; min-width:150px; display:inline-flex; align-items:center; justify-content:center; gap:8px;"><i class="fa-solid fa-book-open"></i> Guidebook</a>`);
                }

                document.getElementById('erBody').innerHTML = htmlResult + `
                <div class="er-footer" style="display:flex; gap:10px; flex-wrap:wrap;">
                    <button class="btn btn-primary" style="flex:1; min-width:170px; font-weight:700;" onclick="joinCompetition(${comp.id}, '${comp.type}')">
                        <i class="fa-solid fa-right-to-bracket"></i> Daftarkan Diri Sekarang
                    </button>
                    <button class="btn ${isSaved ? 'btn-warning' : 'btn-secondary'}" id="saveBtn-${comp.id}" onclick="toggleSave(${comp.id})" style="font-weight:600; min-width:150px;">
                        <i class="fa-solid fa-bookmark" id="saveIcon-${comp.id}"></i>
                        <span id="saveText-${comp.id}">${isSaved ? 'Tersimpan' : 'Simpan'}</span>
                    </button>
                    ${linkButtons.join('')}
                </div>`;
            const newIdx = currentIndex + dir;
            if (newIdx < 0 || newIdx >= compIds.length) return;
            const id = compIds[newIdx];
            const el = document.getElementById('ebc-' + id);
            selectComp(id, el);
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        /**
         * Mengubah parameter URL global untuk memicu filter reload request laravel
         */
        function setFilter(val) { updateURLParam('filter', val); }
        function setCategory(val) { updateURLParam('category', val); }
        function setField(val) { updateURLParam('field', val); }
        function setLevel(val) { updateURLParam('level', val); }
        function setType(val) { updateURLParam('type', val); }

        function updateURLParam(key, value) {
            const url = new URL(window.location.href);
            if (value) url.searchParams.set(key, value);
            else url.searchParams.delete(key);
            window.location.href = url.toString();
        }

        function debounceFilter() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                updateURLParam('search', document.getElementById('searchInput').value);
            }, 500);
        }

        /**
         * Proses penyimpanan asinkron (Toggle Save Bookmark AJAX)
         */
        function toggleSave(id) {
            const saveBtn = document.getElementById(`saveBtn-${id}`);
            const saveText = document.getElementById(`saveText-${id}`);
            
            fetch(`/student/explore/${id}/save`, {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                // Update State Tombol Detail Real-time
                if (data.saved) {
                    if(saveBtn) { saveBtn.className = "btn btn-warning"; saveText.innerText = "Tersimpan"; }
                    // Munculkan / buat badge penanda simpan di komponen bento sidebar kiri jika ada
                    let card = document.getElementById(`ebc-${id}`);
                    if(card && !document.getElementById(`cardBadgeSave-${id}`)) {
                        let badgeContainer = card.querySelector('.eb-badges-top');
                        let divSave = badgeContainer.children[1];
                        divSave.innerHTML = `<span class="badge-ui save" id="cardBadgeSave-${id}"><i class="fa-solid fa-bookmark"></i> Tersimpan</span>`;
                    }
                } else {
                    if(saveBtn) { saveBtn.className = "btn btn-secondary"; saveText.innerText = "Simpan"; }
                    let badgeSave = document.getElementById(`cardBadgeSave-${id}`);
                    if(badgeSave) badgeSave.remove();
                }
            })
            .catch(err => console.error("Gagal memproses manipulasi penyimpanan registri.", err));
        }

        /**
         * Router trigger aksi pendaftaran kompetisi mandiri / berkelompok
         */
        function joinCompetition(id, type) {
            if (type === 'team') {
                if (typeof openModal === 'function') {
                    openModal('Pendaftaran Kelompok Berdua/Tim', `
                        <p style="font-size:0.85rem; color:var(--text-muted); margin-bottom:20px;">
                            Kompetisi ini mewajibkan delegasi berskala <strong>Tim / Berkelompok</strong>. Silakan tentukan opsi langkah manajemen tim Anda:
                        </p>
                        <div style="display:flex; flex-direction:column; gap:10px;">
                            <button class="btn btn-primary text-left" onclick="window.location.href='/student/teams/create?competition_id=${id}'">
                                <i class="fa-solid fa-plus"></i> Inisialisasi / Buat Tim Baru
                            </button>
                            <button class="btn btn-secondary text-left" onclick="window.location.href='/student/teams/join?competition_id=${id}'">
                                <i class="fa-solid fa-key"></i> Gabung Menggunakan Kode Undangan
                            </button>
                        </div>
                    `);
                } else {
                    window.location.href = `/student/teams/create?competition_id=${id}`;
                }
            } else {
                if (typeof openModal === 'function') {
                    openModal('Konfirmasi Klaim Partisipasi', `
                        <p style="font-size:0.85rem; color:var(--text-muted); margin-bottom:20px;">
                            Apakah Anda yakin ingin menyatakan keikutsertaan Anda dalam kompetisi ini secara <strong>Mandiri (Individu)</strong>?
                        </p>
                        <form method="POST" action="/student/participations/join">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="competition_id" value="${id}">
                            <div style="display:flex; gap:10px; justify-content:flex-end;">
                                <button type="button" class="btn btn-secondary" onclick="closeModal()">Batalkan</button>
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Ya, Ambil Slot</button>
                            </div>
                        </form>
                    `);
                } else {
                    alert("Gunakan antarmuka modal terintegrasi aplikasi untuk mengambil tindakan aman.");
                }
            }
        }
    </script>
@endpush