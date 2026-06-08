<aside class="sidebar" id="sidebar">
    <div class="sidebar-section">
        {{-- MENU UTAMA --}}
        <a href="{{ route('student.dashboard') }}"
           class="sidebar-nav-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Beranda</span>
        </a>

        {{-- Pengaturan (collapsible) --}}
        <div class="sidebar-nav-item has-sub {{ request()->routeIs('student.settings*') ? 'active open' : '' }}"
             onclick="toggleSub(this)">
            <i class="fa-solid fa-gear"></i>
            <span>Pengaturan</span>
        </div>
        <div class="sidebar-sub {{ request()->routeIs('student.settings*') ? 'open' : '' }}">
            <a href="{{ route('student.settings.profile') }}"
               class="sidebar-nav-item {{ request()->routeIs('student.settings.profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user-pen"></i> <span>Profil</span>
            </a>
            <a href="{{ route('student.settings.quiz') }}"
               class="sidebar-nav-item {{ request()->routeIs('student.settings.quiz') ? 'active' : '' }}">
                <i class="fa-solid fa-brain"></i> <span>Kuis Karakter</span>
            </a>
            <a href="{{ route('student.settings.privacy') }}"
               class="sidebar-nav-item {{ request()->routeIs('student.settings.privacy') ? 'active' : '' }}">
                <i class="fa-solid fa-lock"></i> <span>Privasi</span>
            </a>
            <a href="{{ route('student.settings.notification') }}"
               class="sidebar-nav-item {{ request()->routeIs('student.settings.notification') ? 'active' : '' }}">
                <i class="fa-solid fa-bell"></i> <span>Notifikasi</span>
            </a>
        </div>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-section">
        <span class="sidebar-label">Lomba</span>

        <a href="{{ route('student.explore') }}"
           class="sidebar-nav-item {{ request()->routeIs('student.explore*') ? 'active' : '' }}">
            <i class="fa-solid fa-compass"></i>
            <span>Eksplor Lomba</span>
        </a>

        <a href="{{ route('student.participations') }}"
           class="sidebar-nav-item {{ request()->routeIs('student.participations*') ? 'active' : '' }}">
            <i class="fa-solid fa-list-check"></i>
            <span>Lomba Saya</span>
            @php $activePart = auth()->user()
                ? \App\Models\Participation::where('user_id', auth()->id())
                    ->whereIn('status', ['registered','in_progress'])->count()
                : 0; @endphp
            @if($activePart > 0)
                <span class="nav-badge">{{ $activePart }}</span>
            @endif
        </a>

        <a href="{{ route('student.recapitulation') }}"
           class="sidebar-nav-item {{ request()->routeIs('student.recapitulation*') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie"></i>
            <span>Rekapitulasi</span>
        </a>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-section">
        <a href="{{ route('student.leaderboard') }}"
           class="sidebar-nav-item {{ request()->routeIs('student.leaderboard') ? 'active' : '' }}">
            <i class="fa-solid fa-ranking-star"></i>
            <span>Leaderboard</span>
        </a>
    </div>

    {{-- User Card --}}
    <div class="sidebar-user">
        <div class="sidebar-user-card">
            @php $u = auth()->user(); @endphp
            @if($u && $u->photo !== 'default-avatar.png' && file_exists(public_path('images/avatars/'.$u->photo)))
                <img src="{{ asset('images/avatars/'.$u->photo) }}" alt="Avatar">
            @else
                <div class="su-avatar">{{ strtoupper(substr($u->name ?? 'U', 0, 2)) }}</div>
            @endif
            <div class="su-info">
                <div class="su-name">{{ $u->name ?? '-' }}</div>
                <div class="su-role">
                    <i class="fa-solid fa-user-graduate"></i>
                    {{ $u->studentProfile->jurusan ?? 'Siswa' }}
                </div>
            </div>
        </div>
    </div>
</aside>