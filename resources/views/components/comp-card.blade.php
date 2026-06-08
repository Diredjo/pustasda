@php
    $levelClass = match ($competition->level) {
        'nasional' => 'level-nasional',
        'internasional' => 'level-internasional',
        'provinsi' => 'level-provinsi',
        'kota' => 'level-kota',
        default => 'level-sekolah',
    };
    $levelLabel = match ($competition->level) {
        'nasional' => 'Nasional',
        'internasional' => 'Internasional',
        'provinsi' => 'Provinsi',
        'kota' => 'Kota',
        default => 'Sekolah',
    };
    $deadlineSoon = $competition->deadline->diffInDays(now()) <= 7 && $competition->deadline->isFuture();
@endphp

<div class="comp-card" onclick="window.location='{{ route('student.explore.show', $competition->id) }}'">
    @if($competition->is_trending)
        <div class="comp-badge-trending">
            <i class="fa-solid fa-fire"></i> Trending
        </div>
    @endif

    {{-- Cover --}}
    @if($competition->cover && file_exists(public_path('storage/' . $competition->cover)))
        <img class="comp-cover" src="{{ asset('storage/' . $competition->cover) }}" alt="{{ $competition->title }}">
    @else
        <div class="comp-cover-placeholder">
            <i class="fa-solid fa-trophy"></i>
        </div>
    @endif

    <div class="comp-body">
        {{-- Kategori --}}
        <div class="comp-cat"
            style="background:{{ $competition->category->color ?? 'var(--red)' }}22; color:{{ $competition->category->color ?? 'var(--red)' }};">
            <i class="fa-solid {{ $competition->category->icon ?? 'fa-trophy' }}"></i>
            {{ $competition->category->name ?? '-' }}
        </div>

        {{-- Judul --}}
        <div class="comp-title">{{ $competition->title }}</div>

        {{-- Penyelenggara --}}
        <div class="comp-organizer">
            <i class="fa-solid fa-building"></i>
            {{ $competition->organizer }}
        </div>

        {{-- Meta --}}
        <div class="comp-meta">
            <span class="comp-tag {{ $levelClass }}">
                <i class="fa-solid fa-flag"></i> {{ $levelLabel }}
            </span>
            <span class="comp-tag {{ $competition->type === 'team' ? 'type-team' : 'type-solo' }}">
                <i class="fa-solid {{ $competition->type === 'team' ? 'fa-users' : 'fa-user' }}"></i>
                {{ $competition->type === 'team' ? 'Tim' : 'Mandiri' }}
            </span>
            @if($competition->deadline->isFuture())
                <span class="comp-tag {{ $deadlineSoon ? 'deadline-soon' : 'deadline-ok' }}">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    {{ $competition->deadline->format('d M Y') }}
                </span>
            @else
                <span class="comp-tag" style="background:#f8d7da;color:#721c24;">
                    <i class="fa-solid fa-calendar-xmark"></i> Berakhir
                </span>
            @endif
        </div>
    </div>
</div>@php
    $levelClass = match ($competition->level) {
        'nasional' => 'level-nasional',
        'internasional' => 'level-internasional',
        'provinsi' => 'level-provinsi',
        'kota' => 'level-kota',
        default => 'level-sekolah',
    };
    $levelLabel = match ($competition->level) {
        'nasional' => 'Nasional',
        'internasional' => 'Internasional',
        'provinsi' => 'Provinsi',
        'kota' => 'Kota',
        default => 'Sekolah',
    };
    $deadlineSoon = $competition->deadline->diffInDays(now()) <= 7 && $competition->deadline->isFuture();
@endphp

<div class="comp-card" onclick="window.location='{{ route('student.explore.show', $competition->id) }}'">
    @if($competition->is_trending)
        <div class="comp-badge-trending">
            <i class="fa-solid fa-fire"></i> Trending
        </div>
    @endif

    {{-- Cover --}}
    @if($competition->cover && file_exists(public_path('storage/' . $competition->cover)))
        <img class="comp-cover" src="{{ asset('storage/' . $competition->cover) }}" alt="{{ $competition->title }}">
    @else
        <div class="comp-cover-placeholder">
            <i class="fa-solid fa-trophy"></i>
        </div>
    @endif

    <div class="comp-body">
        {{-- Kategori --}}
        <div class="comp-cat"
            style="background:{{ $competition->category->color ?? 'var(--red)' }}22; color:{{ $competition->category->color ?? 'var(--red)' }};">
            <i class="fa-solid {{ $competition->category->icon ?? 'fa-trophy' }}"></i>
            {{ $competition->category->name ?? '-' }}
        </div>

        {{-- Judul --}}
        <div class="comp-title">{{ $competition->title }}</div>

        {{-- Penyelenggara --}}
        <div class="comp-organizer">
            <i class="fa-solid fa-building"></i>
            {{ $competition->organizer }}
        </div>

        {{-- Meta --}}
        <div class="comp-meta">
            <span class="comp-tag {{ $levelClass }}">
                <i class="fa-solid fa-flag"></i> {{ $levelLabel }}
            </span>
            <span class="comp-tag {{ $competition->type === 'team' ? 'type-team' : 'type-solo' }}">
                <i class="fa-solid {{ $competition->type === 'team' ? 'fa-users' : 'fa-user' }}"></i>
                {{ $competition->type === 'team' ? 'Tim' : 'Mandiri' }}
            </span>
            @if($competition->deadline->isFuture())
                <span class="comp-tag {{ $deadlineSoon ? 'deadline-soon' : 'deadline-ok' }}">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    {{ $competition->deadline->format('d M Y') }}
                </span>
            @else
                <span class="comp-tag" style="background:#f8d7da;color:#721c24;">
                    <i class="fa-solid fa-calendar-xmark"></i> Berakhir
                </span>
            @endif
        </div>
    </div>
</div>