<nav class="navbar">
    {{-- Brand --}}
    <div class="navbar-brand">
        @php $logo = \App\Models\AppSetting::get('app_logo','') @endphp
        @if($logo && file_exists(public_path('images/'.$logo)))
            <img src="{{ asset('images/'.$logo) }}" alt="PUSTASDA">
        @else
            <div class="brand-fallback"><i class="fa-solid fa-trophy"></i></div>
        @endif
        <span>PUSTASDA</span>
    </div>

    <div class="navbar-divider"></div>
    <span class="navbar-page-title">{{ $pageTitle ?? 'Dashboard' }}</span>
    <div class="navbar-spacer"></div>

    <div class="navbar-actions">
        {{-- Notifikasi --}}
        <div style="position:relative;">
            <button class="navbar-notif" id="btnNotif" title="Notifikasi">
                <i class="fa-solid fa-bell"></i>
                @php
                    $unreadCount = auth()->user()
                        ? \App\Models\Notification::where('user_id', auth()->id())
                            ->where('is_read', false)->count()
                        : 0;
                @endphp
                @if($unreadCount > 0)
                    <span class="badge-count">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                @endif
            </button>

            {{-- Notif Panel --}}
            <div class="notif-panel" id="notifPanel">
                <div class="notif-panel-header">
                    <h4><i class="fa-solid fa-bell text-red" style="margin-right:6px;"></i>Notifikasi</h4>
                    <button class="mark-all" onclick="markAllRead()">Tandai semua dibaca</button>
                </div>
                <div class="notif-list" id="notifList">
                    @php
                        $notifications = auth()->user()
                            ? \App\Models\Notification::where('user_id', auth()->id())
                                ->latest()->take(10)->get()
                            : collect();
                    @endphp
                    @forelse($notifications as $notif)
                    <div class="notif-item {{ !$notif->is_read ? 'unread' : '' }}"
                         onclick="readNotif({{ $notif->id }})">
                        <div class="notif-icon" style="background:{{ $notif->color }}22; color:{{ $notif->color }};">
                            <i class="fa-solid {{ $notif->icon }}"></i>
                        </div>
                        <div class="notif-text">
                            <div class="notif-title">{{ $notif->title }}</div>
                            <div class="notif-body">{{ Str::limit($notif->body, 60) }}</div>
                            <div class="notif-time">{{ $notif->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="notif-empty">
                        <i class="fa-regular fa-bell-slash" style="font-size:1.8rem;margin-bottom:8px;display:block;"></i>
                        Belum ada notifikasi
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Profile Avatar --}}
        <div style="position:relative;">
            <div class="navbar-avatar" id="btnAvatar">
                @if(auth()->user() && auth()->user()->photo !== 'default-avatar.png' && file_exists(public_path('images/avatars/'.auth()->user()->photo)))
                    <img src="{{ asset('images/avatars/'.auth()->user()->photo) }}" alt="Avatar">
                @else
                    <div class="avatar-fallback">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}</div>
                @endif
                <span class="avatar-name">{{ auth()->user()->name ?? 'User' }}</span>
                <i class="fa-solid fa-chevron-down" style="font-size:0.65rem; color:var(--gray); margin-left:2px;"></i>
            </div>

            {{-- Dropdown --}}
            <div class="dropdown-menu" id="avatarDropdown">
                <div class="dd-header">
                    <div class="dd-name">{{ auth()->user()->name ?? '-' }}</div>
                    <div class="dd-role">
                        @switch(auth()->user()->role ?? '')
                            @case('student')   <i class="fa-solid fa-user-graduate"></i> Siswa @break
                            @case('teacher')   <i class="fa-solid fa-chalkboard-teacher"></i> Guru @break
                            @case('admin')     <i class="fa-solid fa-shield-halved"></i> Admin @break
                            @case('developer') <i class="fa-solid fa-code"></i> Developer @break
                        @endswitch
                    </div>
                </div>
                <a href="{{ route(auth()->user()->role.'.profile') ?? '#' }}">
                    <i class="fa-solid fa-id-card text-gray"></i> Profil Saya
                </a>
                <a href="{{ route(auth()->user()->role.'.settings') ?? '#' }}">
                    <i class="fa-solid fa-gear text-gray"></i> Pengaturan
                </a>
                <div class="dd-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dd-logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>