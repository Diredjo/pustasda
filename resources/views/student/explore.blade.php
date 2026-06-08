@extends('layouts.app-student')
@section('title', 'Eksplor Lomba')
@php $pageTitle = 'Eksplor Lomba'; @endphp

@push('styles')
    <style>
        /* ===== EXPLORER LAYOUT ===== */
        .explorer-wrap {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 20px;
            height: calc(100vh - var(--navbar-h) - 56px - 80px);
            min-height: 600px;
        }

        /* ===== PANEL KIRI: BENTO GRID ===== */
        .explorer-left {
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        .explorer-toolbar {
            display: flex;
            gap: 10px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .explorer-grid-scroll {
            flex: 1;
            overflow-y: auto;
            padding-right: 6px;
        }

        .explorer-bento {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .eb-card {
            border-radius: var(--radius);
            border: 1.5px solid var(--gray-mid);
            overflow: hidden;
            cursor: pointer;
            transition: all var(--transition);
            background: var(--white);
            position: relative;
        }

        .eb-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--red);
        }

        .eb-card.active {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(227, 30, 37, 0.12);
        }

        .eb-cover {
            width: 100%;
            height: 110px;
            object-fit: cover;
            display: block;
            background: linear-gradient(135deg, #fff3f3, #ffe0e0);
        }

        .eb-cover-ph {
            width: 100%;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fff3f3, #ffe0e0);
            color: var(--red);
            font-size: 1.8rem;
        }

        .eb-body {
            padding: 10px;
        }

        .eb-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .eb-org {
            font-size: 0.7rem;
            color: var(--gray);
        }

        .eb-meta {
            display: flex;
            gap: 5px;
            margin-top: 5px;
            flex-wrap: wrap;
        }

        .eb-tag {
            font-size: 0.62rem;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .eb-trending {
            position: absolute;
            top: 6px;
            right: 6px;
            background: var(--red);
            color: #fff;
            font-size: 0.6rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .eb-saved-badge {
            position: absolute;
            top: 6px;
            left: 6px;
            background: var(--yellow);
            color: #fff;
            font-size: 0.6rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }

        /* ===== PANEL KANAN: DETAIL SCROLL ===== */
        .explorer-right {
            display: flex;
            flex-direction: column;
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .er-header {
            padding: 14px 16px;
            border-bottom: 1px solid var(--gray-mid);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .er-header h4 {
            font-size: 0.88rem;
            font-weight: 700;
        }

        .er-nav {
            display: flex;
            gap: 4px;
        }

        .er-nav-btn {
            width: 30px;
            height: 30px;
            border: 1.5px solid var(--gray-mid);
            border-radius: 6px;
            background: var(--white);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            font-size: 0.8rem;
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
            padding: 0;
        }

        /* Detail card */
        .er-poster {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: linear-gradient(135deg, #fff3f3, #ffe0e0);
        }

        .er-poster-ph {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fff3f3, #ffe0e0);
            color: var(--red);
            font-size: 3rem;
        }

        .er-content {
            padding: 18px;
        }

        .er-cat {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .er-title {
            font-family: var(--font-main);
            font-size: 1rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.4;
            margin-bottom: 6px;
        }

        .er-organizer {
            font-size: 0.82rem;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 14px;
        }

        .er-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .er-info-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 8px;
            font-size: 0.82rem;
        }

        .er-info-row i {
            width: 16px;
            color: var(--red);
            margin-top: 1px;
            flex-shrink: 0;
        }

        .er-info-label {
            color: var(--gray);
            min-width: 90px;
            font-size: 0.78rem;
        }

        .er-info-value {
            color: var(--dark);
            font-weight: 600;
        }

        .er-desc-title {
            font-weight: 700;
            font-size: 0.85rem;
            margin: 14px 0 6px;
        }

        .er-desc {
            font-size: 0.82rem;
            color: #444;
            line-height: 1.7;
        }

        .er-stages {
            margin-top: 14px;
        }

        .er-stage-item {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 8px 0;
            border-bottom: 1px solid var(--gray-light);
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
            font-size: 0.72rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .er-footer {
            padding: 14px 18px;
            border-top: 1px solid var(--gray-mid);
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, var(--gray-light) 25%, #e9ecef 50%, var(--gray-light) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 6px;
        }

        @keyframes shimmer {
            to {
                background-position: -200% 0;
            }
        }

        @media(max-width:1100px) {
            .explorer-wrap {
                grid-template-columns: 1fr;
                height: auto;
            }

            .explorer-right {
                min-height: 500px;
            }

            .explorer-bento {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
@endpush

@section('content')

    <div class="page-header" style="margin-bottom:16px;">
        <h1><i class="fa-solid fa-compass text-red"></i> Eksplor Lomba</h1>
        <p>Temukan lomba yang sesuai minat dan bakatmu</p>
    </div>

    {{-- Filter Bar --}}
    <div class="filter-bar" style="margin-bottom:14px;">
        <div class="search-box" style="max-width:280px;">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" placeholder="Cari nama lomba..." value="{{ request('search') }}"
                oninput="debounceFilter()">
        </div>

        <button class="filter-chip {{ !request('filter') && !request('category') ? 'active' : '' }}"
            onclick="setFilter('')">Semua</button>
        <button class="filter-chip {{ request('filter') === 'trending' ? 'active' : '' }}" onclick="setFilter('trending')"><i
                class="fa-solid fa-fire"></i> Trending</button>
        <button class="filter-chip {{ request('filter') === 'terbaru' ? 'active' : '' }}" onclick="setFilter('terbaru')"><i
                class="fa-solid fa-clock"></i> Terbaru</button>
        <button class="filter-chip {{ request('filter') === 'nasional' ? 'active' : '' }}" onclick="setFilter('nasional')"><i
                class="fa-solid fa-flag"></i> Nasional</button>
        <button class="filter-chip {{ request('filter') === 'deadline' ? 'active' : '' }}" onclick="setFilter('deadline')"><i
                class="fa-solid fa-hourglass"></i> Deadline Dekat</button>

        <select class="form-control" style="width:auto; padding:6px 12px; font-size:0.78rem;"
            onchange="setLevel(this.value)">
            <option value="">Semua Level</option>
            <option value="kota" {{ request('level') === 'kota' ? 'selected' : '' }}>Kota</option>
            <option value="provinsi" {{ request('level') === 'provinsi' ? 'selected' : '' }}>Provinsi</option>
            <option value="nasional" {{ request('level') === 'nasional' ? 'selected' : '' }}>Nasional</option>
            <option value="internasional" {{ request('level') === 'internasional' ? 'selected' : '' }}>Internasional</option>
        </select>

        <select class="form-control" style="width:auto; padding:6px 12px; font-size:0.78rem;"
            onchange="setType(this.value)">
            <option value="">Semua Tipe</option>
            <option value="solo" {{ request('type') === 'solo' ? 'selected' : '' }}>Mandiri</option>
            <option value="team" {{ request('type') === 'team' ? 'selected' : '' }}>Tim</option>
        </select>
    </div>

    <div class="explorer-wrap">
        {{-- KIRI: BENTO GRID --}}
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
                                @if($comp->is_trending)
                                    <div class="eb-trending"><i class="fa-solid fa-fire"></i> Tren</div>
                                @endif
                                @if($isSaved)
                                    <div class="eb-saved-badge"><i class="fa-solid fa-bookmark"></i> Tersimpan</div>
                                @endif

                                @if($comp->cover && file_exists(public_path('storage/' . $comp->cover)))
                                    <img class="eb-cover" src="{{ asset('storage/' . $comp->cover) }}" alt="{{ $comp->title }}">
                                @else
                                    <div class="eb-cover-ph"><i class="fa-solid fa-trophy"></i></div>
                                @endif

                                <div class="eb-body">
                                    <div class="eb-title">{{ $comp->title }}</div>
                                    <div class="eb-org"><i class="fa-solid fa-building"></i> {{ Str::limit($comp->organizer, 30) }}
                                    </div>
                                    <div class="eb-meta">
                                        <span class="eb-tag {{ $deadlineSoon ? 'deadline-soon' : 'deadline-ok' }}">
                                            <i class="fa-solid fa-calendar"></i> {{ $comp->deadline->format('d M') }}
                                        </span>
                                        <span class="eb-tag {{ $comp->type === 'team' ? 'type-team' : 'type-solo' }}">
                                            <i class="fa-solid {{ $comp->type === 'team' ? 'fa-users' : 'fa-user' }}"></i>
                                            {{ $comp->type === 'team' ? 'Tim' : 'Solo' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fa-solid fa-box-open"></i>
                        <h3>Tidak ada lomba ditemukan</h3>
                        <p>Coba ubah filter pencarianmu</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- KANAN: DETAIL --}}
        <div class="explorer-right" id="explorerRight">
            <div class="er-header">
                <h4><i class="fa-solid fa-circle-info text-red"></i> Detail Lomba</h4>
                <div class="er-nav">
                    <button class="er-nav-btn" onclick="navComp(-1)" title="Lomba sebelumnya">
                        <i class="fa-solid fa-chevron-up"></i>
                    </button>
                    <button class="er-nav-btn" onclick="navComp(1)" title="Lomba berikutnya">
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div>
            </div>
            <div class="er-body" id="erBody">
                @if($firstComp)
                    @include('components.comp-detail', ['comp' => $firstComp, 'savedIds' => $savedIds, 'saveFolders' => $saveFolders])
                @else
                    <div class="empty-state" style="margin-top:60px;">
                        <i class="fa-solid fa-hand-pointer"></i>
                        <h3>Pilih lomba</h3>
                        <p>Klik salah satu lomba di sebelah kiri untuk melihat detail</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Data kompetisi untuk navigasi
        const compIds = @json($competitions->pluck('id')->values());
        let currentIndex = {{ isset($firstComp) ? $competitions->search(fn($c) => $c->id === $firstComp->id) : 0 }};
        let debounceTimer;

        // Pilih kompetisi
        function selectComp(id, el) {
            document.querySelectorAll('.eb-card').forEach(c => c.classList.remove('active'));
            if (el) el.classList.add('active');
            currentIndex = compIds.indexOf(id);

            // Loading state
            document.getElementById('erBody').innerHTML =
                `<div style="padding:24px;">
                <div class="skeleton" style="height:200px; border-radius:0; margin-bottom:18px;"></div>
                <div style="padding:0 18px;">
                    <div class="skeleton" style="height:14px; width:40%; margin-bottom:10px;"></div>
                    <div class="skeleton" style="height:22px; margin-bottom:8px;"></div>
                    <div class="skeleton" style="height:16px; width:60%; margin-bottom:18px;"></div>
                    <div class="skeleton" style="height:12px; margin-bottom:8px;"></div>
                    <div class="skeleton" style="height:12px; width:80%; margin-bottom:8px;"></div>
                    <div class="skeleton" style="height:12px; width:70%;"></div>
                </div>
            </div>`;

            fetch(`/student/explore/${id}`)
                .then(r => r.json())
                .then(data => {
                    renderDetail(data);
                });
        }

        // Render detail panel
        function renderDetail(comp) {
            const isSaved = @json($savedIds).includes(comp.id);
            const levelMap = { nasional: 'level-nasional', internasional: 'level-internasional', provinsi: 'level-provinsi', kota: 'level-kota', sekolah: 'level-sekolah' };
            const levelLabel = { nasional: 'Nasional', internasional: 'Internasional', provinsi: 'Provinsi', kota: 'Kota/Kab', sekolah: 'Sekolah' };

            let stagesHtml = '';
            if (comp.stages && comp.stages.length > 1) {
                stagesHtml = `<div class="er-stages">
                <div class="er-desc-title"><i class="fa-solid fa-layer-group text-red"></i> Tahapan Lomba</div>
                ${comp.stages.map(s => `
                    <div class="er-stage-item">
                        <div class="er-stage-num">${s.stage_number}</div>
                        <div>
                            <div style="font-weight:700;font-size:0.82rem;">${s.stage_name}</div>
                            <div style="font-size:0.75rem;color:var(--gray);">${s.deadline ? 'Deadline: ' + s.deadline : ''}</div>
                            <div style="font-size:0.78rem;margin-top:3px;">${s.description || ''}</div>
                        </div>
                    </div>`).join('')}
            </div>`;
            }

            const posterSrc = comp.poster
                ? `/storage/${comp.poster}`
                : null;

            document.getElementById('erBody').innerHTML = `
            ${posterSrc
                    ? `<img class="er-poster" src="${posterSrc}" alt="${comp.title}" onerror="this.outerHTML='<div class=\\'er-poster-ph\\'><i class=\\'fa-solid fa-trophy\\'></i></div>'">`
                    : `<div class="er-poster-ph"><i class="fa-solid fa-trophy"></i></div>`}

            <div class="er-content">
                <div class="er-cat" style="background:${comp.category?.color || 'var(--red)'}22;color:${comp.category?.color || 'var(--red)'};">
                    <i class="fa-solid ${comp.category?.icon || 'fa-trophy'}"></i>
                    ${comp.category?.name || '-'}
                </div>

                <div class="er-title">${comp.title}</div>
                <div class="er-organizer"><i class="fa-solid fa-building"></i> ${comp.organizer}</div>

                <div class="er-tags">
                    <span class="comp-tag ${levelMap[comp.level] || ''}">
                        <i class="fa-solid fa-flag"></i> ${levelLabel[comp.level] || comp.level}
                    </span>
                    <span class="comp-tag ${comp.type === 'team' ? 'type-team' : 'type-solo'}">
                        <i class="fa-solid ${comp.type === 'team' ? 'fa-users' : 'fa-user'}"></i>
                        ${comp.type === 'team' ? `Tim (${comp.min_members}-${comp.max_members} orang)` : 'Mandiri'}
                    </span>
                    ${comp.field ? `<span class="comp-tag" style="background:var(--gray-light);color:var(--gray);">
                        <i class="fa-solid ${comp.field.icon}"></i> ${comp.field.name}
                    </span>` : ''}
                </div>

                <div class="er-info-row">
                    <i class="fa-solid fa-calendar-alt"></i>
                    <span class="er-info-label">Deadline Daftar</span>
                    <span class="er-info-value">${comp.register_deadline || 'Tidak ditentukan'}</span>
                </div>
                <div class="er-info-row">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    <span class="er-info-label">Deadline Submit</span>
                    <span class="er-info-value">${comp.deadline}</span>
                </div>
                <div class="er-info-row">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span class="er-info-label">Pengumuman</span>
                    <span class="er-info-value">${comp.announcement_date || 'Belum ditentukan'}</span>
                </div>
                ${comp.link_registration ? `
                <div class="er-info-row">
                    <i class="fa-solid fa-link"></i>
                    <span class="er-info-label">Link Daftar</span>
                    <a href="${comp.link_registration}" target="_blank" class="er-info-value text-red" style="word-break:break-all;">
                        Buka Link <i class="fa-solid fa-external-link"></i>
                    </a>
                </div>` : ''}

                ${comp.description ? `
                <div class="er-desc-title"><i class="fa-solid fa-align-left text-red"></i> Deskripsi</div>
                <div class="er-desc">${comp.description}</div>` : ''}

                ${comp.requirements ? `
                <div class="er-desc-title"><i class="fa-solid fa-clipboard-list text-red"></i> Ketentuan</div>
                <div class="er-desc">${comp.requirements}</div>` : ''}

                ${stagesHtml}
            </div>

            <div class="er-footer" id="erFooter-${comp.id}">
                <button class="btn btn-primary" onclick="joinCompetition(${comp.id}, '${comp.type}', ${comp.total_stages})">
                    <i class="fa-solid fa-right-to-bracket"></i> Ikut Lomba Ini
                </button>
                <button class="btn btn-secondary" id="saveBtn-${comp.id}"
                        onclick="toggleSave(${comp.id})">
                    <i class="fa-solid ${isSaved ? 'fa-bookmark' : 'fa-bookmark'}" id="saveIcon-${comp.id}"></i>
                    ${isSaved ? 'Tersimpan' : 'Simpan'}
                </button>
                ${comp.link_registration ? `
                <a href="${comp.link_registration}" target="_blank" class="btn btn-outline-red">
                    <i class="fa-solid fa-external-link-alt"></i> Daftar Langsung
                </a>` : ''}
            </div>`;

            // Init countdown
            if (comp.deadline) {
                const deadlineEl = document.createElement('div');
                deadlineEl.style.cssText = 'padding:0 18px 10px; font-size:0.75rem; color:var(--gray);';
                deadlineEl.innerHTML = `<i class="fa-solid fa-hourglass-half text-red"></i> Sisa waktu: <span id="cd-er-${comp.id}"></span>`;
                document.getElementById('erBody').insertBefore(deadlineEl, document.querySelector('.er-content'));
                startCountdown(comp.deadline + 'T23:59:59', `cd-er-${comp.id}`);
            }
        }

        // Navigasi atas/bawah
        function navComp(dir) {
            const newIdx = currentIndex + dir;
            if (newIdx < 0 || newIdx >= compIds.length) return;
            const id = compIds[newIdx];
            const el = document.getElementById('ebc-' + id);
            selectComp(id, el);
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        // Join lomba
        function joinCompetition(id, type, stages) {
            if (type === 'team') {
                openModal('Ikut Lomba Tim', `
                <p style="font-size:0.88rem;color:var(--gray);margin-bottom:20px;">
                    Lomba ini adalah lomba <strong>berkelompok</strong>. Pilih mode bergabung:
                </p>
                <div style="display:flex;flex-direction:column;gap:10px;">
                    <button class="btn btn-primary btn-block" onclick="createTeam(${id})">
                        <i class="fa-solid fa-plus"></i> Buat Tim Baru
                    </button>
                    <button class="btn btn-secondary btn-block" onclick="joinTeamByCode(${id})">
                        <i class="fa-solid fa-link"></i> Masuk via Kode Undangan
                    </button>
                    <button class="btn btn-outline-red btn-block" onclick="browseTeams(${id})">
                        <i class="fa-solid fa-search"></i> Cari Tim yang Butuh Anggota
                    </button>
                </div>
            `);
            } else {
                openModal('Konfirmasi Ikut Lomba', `
                <p style="font-size:0.88rem;color:var(--gray);margin-bottom:20px;">
                    Apakah kamu yakin ingin mengikuti lomba ini secara <strong>mandiri</strong>?
                </p>
                <form method="POST" action="/student/participations/join">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="competition_id" value="${id}">
                    <div style="display:flex;gap:8px;">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa-solid fa-check"></i> Ya, Ikut Sekarang
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                    </div>
                </form>
            `);
            }
        }

        // Save / Unsave
        function toggleSave(id) {
            fetch(`/student/explore/${id}/save`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            })
                .then(r => r.json())
                .then(data => {
                    const btn = document.getElementById('saveBtn-' + id);
                    const icon = document.getElementById('saveIcon-' + id);
                    if (data.saved) {
                        if (btn) btn.innerHTML = '<i class="fa-solid fa-bookmark" id="saveIcon-' + id + '"></i> Tersimpan';
                        showToast('Disimpan', 'Lomba berhasil ditambahkan ke daftar simpan.', 'success');
                    } else {
                        if (btn) btn.innerHTML = '<i class="fa-regular fa-bookmark" id="saveIcon-' + id + '"></i> Simpan';
                        showToast('Dihapus', 'Lomba dihapus dari daftar simpan.');
                    }
                });
        }

        // Filter helpers
        function setFilter(f) {
            const url = new URL(window.location);
            if (f) url.searchParams.set('filter', f);
            else url.searchParams.delete('filter');
            window.location = url;
        }
        function setLevel(v) {
            const url = new URL(window.location);
            if (v) url.searchParams.set('level', v);
            else url.searchParams.delete('level');
            window.location = url;
        }
        function setType(v) {
            const url = new URL(window.location);
            if (v) url.searchParams.set('type', v);
            else url.searchParams.delete('type');
            window.location = url;
        }
        function debounceFilter() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const url = new URL(window.location);
                const val = document.getElementById('searchInput').value;
                if (val) url.searchParams.set('search', val);
                else url.searchParams.delete('search');
                window.location = url;
            }, 600);
        }

        // Create / Join team placeholders
        function createTeam(id) {
            closeModal();
            window.location = `/student/teams/create?competition_id=${id}`;
        }
        function joinTeamByCode(id) {
            openModal('Masuk via Kode Undangan', `
            <div class="form-group">
                <label>Kode Undangan Tim</label>
                <input type="text" class="form-control" id="inviteCodeInput" placeholder="Contoh: TEAM-ABC123" style="text-transform:uppercase; letter-spacing:2px;">
            </div>
            <div style="display:flex;gap:8px;margin-top:8px;">
                <button class="btn btn-primary" onclick="submitJoinCode(${id})">
                    <i class="fa-solid fa-right-to-bracket"></i> Bergabung
                </button>
                <button class="btn btn-secondary" onclick="closeModal()">Batal</button>
            </div>
        `);
        }
        function browseTeams(id) {
            closeModal();
            window.location = `/student/teams?competition_id=${id}`;
        }
        function submitJoinCode(id) {
            const code = document.getElementById('inviteCodeInput').value;
            window.location = `/student/teams/join?code=${code}`;
        }
    </script>
@endpush