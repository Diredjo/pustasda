<aside class="sidebar" id="sidebar">
    <div class="sidebar-section">
        <a href="{{ route('teacher.dashboard') }}"
            class="sidebar-nav-item {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i><span>Dashboard</span>
        </a>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-section">
        <span class="sidebar-label">Bimbingan</span>

        <a href="{{ route('teacher.mentorships') }}"
            class="sidebar-nav-item {{ request()->routeIs('teacher.mentorships*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-tie"></i><span>Kelola Bimbingan</span>
            @php
                $pendingCount = \App\Models\Mentorship::where('teacher_id', auth()->id())
                    ->where('status', 'pending')->count();
            @endphp
            @if($pendingCount > 0)
                <span class="nav-badge">{{ $pendingCount }}</span>
            @endif
        </a>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-section">
        <a href="{{ route('teacher.profile') }}"
            class="sidebar-nav-item {{ request()->routeIs('teacher.profile') ? 'active' : '' }}">
            <i class="fa-solid fa-id-card"></i><span>Profil Saya</span>
        </a>
    </div>

    <div class="sidebar-user">
        <div class="sidebar-user-card">
            @php $u = auth()->user(); @endphp
            <div class="su-avatar">{{ strtoupper(substr($u->name ?? 'G', 0, 2)) }}</div>
            <div class="su-info">
                <div class="su-name">{{ $u->name ?? '-' }}</div>
                <div class="su-role"><i class="fa-solid fa-chalkboard-teacher"></i>
                    {{ $u->teacherProfile->bidang_keahlian ?? 'Guru' }}
                </div>
            </div>
        </div>
    </div>
</aside>