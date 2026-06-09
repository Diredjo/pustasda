@php
    $levelClass = match ($comp->level) {
        'nasional' => 'level-nasional',
        'internasional' => 'level-internasional',
        'provinsi' => 'level-provinsi',
        'kota' => 'level-kota',
        default => 'level-sekolah',
    };
    $levelLabel = match ($comp->level) {
        'nasional' => 'Nasional',
        'internasional' => 'Internasional',
        'provinsi' => 'Provinsi',
        'kota' => 'Kota/Kab',
        default => 'Sekolah',
    };
    $isSaved = in_array($comp->id, $savedIds ?? []);
@endphp

@if($comp->poster && file_exists(public_path('storage/' . $comp->poster)))
    <img class="er-poster" src="{{ asset('storage/' . $comp->poster) }}" alt="{{ $comp->title }}">
@else
    <div class="er-poster-ph"><i class="fa-solid fa-trophy"></i></div>
@endif

{{-- Countdown --}}
@if($comp->deadline->isFuture())
    <div style="padding:10px 18px 0; font-size:0.75rem; color:var(--gray);">
        <i class="fa-solid fa-hourglass-half text-red"></i> Sisa waktu:
        <span id="cd-er-{{ $comp->id }}"></span>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () =>
            startCountdown('{{ $comp->deadline->toIso8601String() }}', 'cd-er-{{ $comp->id }}')
        );
    </script>
@endif

<div class="er-content">
    <div class="er-cat"
        style="background:{{ $comp->category->color ?? 'var(--red)' }}22; color:{{ $comp->category->color ?? 'var(--red)' }};">
        <i class="fa-solid {{ $comp->category->icon ?? 'fa-trophy' }}"></i>
        {{ $comp->category->name ?? '-' }}
    </div>

    <div class="er-title">{{ $comp->title }}</div>
    <div class="er-organizer"><i class="fa-solid fa-building"></i> {{ $comp->organizer }}</div>

    <div class="er-tags">
        <span class="comp-tag {{ $levelClass }}">
            <i class="fa-solid fa-flag"></i> {{ $levelLabel }}
        </span>
        <span class="comp-tag {{ $comp->type === 'team' ? 'type-team' : 'type-solo' }}">
            <i class="fa-solid {{ $comp->type === 'team' ? 'fa-users' : 'fa-user' }}"></i>
            {{ $comp->type === 'team' ? 'Tim (' . $comp->min_members . '-' . $comp->max_members . ' org)' : 'Mandiri' }}
        </span>
        @if($comp->field)
            <span class="comp-tag" style="background:var(--gray-light); color:var(--gray);">
                <i class="fa-solid {{ $comp->field->icon }}"></i> {{ $comp->field->name }}
            </span>
        @endif
    </div>

    <div class="er-info-row">
        <i class="fa-solid fa-calendar-alt"></i>
        <span class="er-info-label">Deadline Daftar</span>
        <span
            class="er-info-value">{{ $comp->register_deadline ? $comp->register_deadline->format('d M Y') : 'Tidak ditentukan' }}</span>
    </div>
    <div class="er-info-row">
        <i class="fa-solid fa-calendar-xmark"></i>
        <span class="er-info-label">Deadline Submit</span>
        <span class="er-info-value">{{ $comp->deadline->format('d M Y') }}</span>
    </div>
    <div class="er-info-row">
        <i class="fa-solid fa-bullhorn"></i>
        <span class="er-info-label">Pengumuman</span>
        <span
            class="er-info-value">{{ $comp->announcement_date ? $comp->announcement_date->format('d M Y') : 'Belum ditentukan' }}</span>
    </div>
    @if($comp->link_registration || $comp->guidebook_link)
        <div class="er-info-row" style="align-items:flex-start; gap:12px; flex-wrap:wrap;">
            <i class="fa-solid fa-link"></i>
            <span class="er-info-label" style="min-width:110px;">Tautan</span>
            <span class="er-info-value" style="display:flex; gap:8px; flex-wrap:wrap;">
                @if($comp->link_registration)
                    <a href="{{ $comp->link_registration }}" target="_blank" class="btn btn-outline-red btn-sm" style="font-weight:700; display:inline-flex; align-items:center; gap:6px;">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Daftar
                    </a>
                @endif
                @if($comp->guidebook_link)
                    <a href="{{ $comp->guidebook_link }}" target="_blank" class="btn btn-secondary btn-sm" style="font-weight:700; display:inline-flex; align-items:center; gap:6px;">
                        <i class="fa-solid fa-book-open"></i> Guidebook
                    </a>
                @endif
            </span>
        </div>
    @endif

    @if($comp->description)
        <div class="er-desc-title"><i class="fa-solid fa-align-left text-red"></i> Deskripsi</div>
        <div class="er-desc">{{ $comp->description }}</div>
    @endif

    @if($comp->requirements)
        <div class="er-desc-title"><i class="fa-solid fa-clipboard-list text-red"></i> Ketentuan</div>
        <div class="er-desc">{{ $comp->requirements }}</div>
    @endif

    {{-- Stages --}}
    @if($comp->stages && $comp->stages->count() > 1)
        <div class="er-stages">
            <div class="er-desc-title"><i class="fa-solid fa-layer-group text-red"></i> Tahapan Lomba</div>
            @foreach($comp->stages as $stage)
                <div class="er-stage-item">
                    <div class="er-stage-num">{{ $stage->stage_number }}</div>
                    <div>
                        <div style="font-weight:700; font-size:0.82rem;">{{ $stage->stage_name }}</div>
                        @if($stage->deadline)
                            <div style="font-size:0.75rem; color:var(--gray);">
                                <i class="fa-solid fa-calendar"></i> Deadline: {{ $stage->deadline->format('d M Y') }}
                            </div>
                        @endif
                        @if($stage->description)
                            <div style="font-size:0.78rem; margin-top:3px;">{{ $stage->description }}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="er-footer">
    <button class="btn btn-primary"
        onclick="joinCompetition({{ $comp->id }}, '{{ $comp->type }}', {{ $comp->total_stages }})">
        <i class="fa-solid fa-right-to-bracket"></i> Ikut Lomba Ini
    </button>
    <button class="btn btn-secondary" id="saveBtn-{{ $comp->id }}" onclick="toggleSave({{ $comp->id }})">
        <i class="fa-solid {{ $isSaved ? 'fa-bookmark' : 'fa-bookmark' }}" id="saveIcon-{{ $comp->id }}"></i>
        {{ $isSaved ? 'Tersimpan' : 'Simpan' }}
    </button>
    @if($comp->link_registration)
        <a href="{{ $comp->link_registration }}" target="_blank" class="btn btn-outline-red btn-sm">
            <i class="fa-solid fa-external-link-alt"></i> Daftar Langsung
        </a>
    @endif
    @if($comp->guidebook_link)
        <a href="{{ $comp->guidebook_link }}" target="_blank" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-book-open"></i> Guidebook
        </a>
    @endif
</div>