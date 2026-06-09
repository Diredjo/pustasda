<aside class="sidebar" id="sidebar">
    <div class="sidebar-section">
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i><span>Dashboard</span>
        </a>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-section">
        <span class="sidebar-label">Manajemen User</span>

        <a href="{{ route('admin.users.index', ['role' => 'student']) }}"
            class="sidebar-nav-item {{ request()->routeIs('admin.users*') && request('role', 'student') === 'student' ? 'active' : '' }}">
            <i class="fa-solid fa-user-graduate"></i><span>Data Siswa</span>
            <span class="nav-badge">{{ \App\Models\User::where('role', 'student')->count() }}</span>
        </a>

        <a href="{{ route('admin.users.index', ['role' => 'teacher']) }}"
            class="sidebar-nav-item {{ request()->routeIs('admin.users*') && request('role') === 'teacher' ? 'active' : '' }}">
            <i class="fa-solid fa-chalkboard-teacher"></i><span>Data Guru</span>
            <span class="nav-badge">{{ \App\Models\User::where('role', 'teacher')->count() }}</span>
        </a>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-section">
        <span class="sidebar-label">Manajemen Lomba</span>

        <a href="{{ route('admin.competitions.index') }}"
            class="sidebar-nav-item {{ request()->routeIs('admin.competitions*') ? 'active' : '' }}">
            <i class="fa-solid fa-trophy"></i><span>Data Lomba</span>
            <span class="nav-badge">{{ \App\Models\Competition::count() }}</span>
        </a>

        <a href="{{ route('admin.categories.index') }}"
            class="sidebar-nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <i class="fa-solid fa-tags"></i><span>Kategori</span>
        </a>

        <a href="{{ route('admin.fields.index') }}"
            class="sidebar-nav-item {{ request()->routeIs('admin.fields*') ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group"></i><span>Bidang Lomba</span>
        </a>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-section">
        <a href="{{ route('admin.leaderboard') }}"
            class="sidebar-nav-item {{ request()->routeIs('admin.leaderboard') ? 'active' : '' }}">
            <i class="fa-solid fa-ranking-star"></i><span>Leaderboard</span>
        </a>
    </div>

    <div class="sidebar-user">
        <div class="sidebar-user-card">
            @php $u = auth()->user(); @endphp
            <div class="su-avatar">{{ strtoupper(substr($u->name ?? 'A', 0, 2)) }}</div>
            <div class="su-info">
                <div class="su-name">{{ $u->name ?? '-' }}</div>
                <div class="su-role"><i class="fa-solid fa-shield-halved"></i> Admin</div>
            </div>
        </div>
    </div>
</aside>