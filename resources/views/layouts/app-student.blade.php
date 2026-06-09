<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="icon" href="{{ asset('images/iconappround.png') }}" type="image/png">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">

    {{-- Global CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Page CSS --}}
    @stack('styles')
</head>

<body>

    <div class="app-layout">
        @php $pageTitle = $pageTitle ?? 'Dashboard'; @endphp
        @include('layouts.navbar', ['pageTitle' => $pageTitle])

        <div class="app-body">
            @include('layouts.sidebar-student')

            <main class="main-content" id="mainContent">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Toast Container --}}
    <div class="toast-container" id="toastContainer"></div>

    {{-- Modal Overlay (global) --}}
    <div class="modal-overlay" id="globalModal">
        <div class="modal-box" id="globalModalBox">
            <div class="modal-header">
                <h3 id="globalModalTitle">-</h3>
                <button class="modal-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div id="globalModalBody"></div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    {{-- Global JS --}}
    <script>
        // ---- Dropdown toggles ----
        document.getElementById('btnAvatar').addEventListener('click', function (e) {
            e.stopPropagation();
            const dd = document.getElementById('avatarDropdown');
            document.getElementById('notifPanel').classList.remove('open');
            dd.classList.toggle('open');
        });
        document.getElementById('btnNotif').addEventListener('click', function (e) {
            e.stopPropagation();
            const np = document.getElementById('notifPanel');
            document.getElementById('avatarDropdown').classList.remove('open');
            np.classList.toggle('open');
        });
        document.addEventListener('click', function () {
            document.getElementById('avatarDropdown').classList.remove('open');
            document.getElementById('notifPanel').classList.remove('open');
        });

        // ---- Sidebar submenu ----
        function toggleSub(el) {
            el.classList.toggle('open');
            const sub = el.nextElementSibling;
            if (sub && sub.classList.contains('sidebar-sub')) {
                sub.classList.toggle('open');
            }
        }

        // ---- Modal ----
        function openModal(title, bodyHtml) {
            document.getElementById('globalModalTitle').textContent = title;
            document.getElementById('globalModalBody').innerHTML = bodyHtml;
            document.getElementById('globalModal').classList.add('open');
        }
        function closeModal() {
            document.getElementById('globalModal').classList.remove('open');
        }
        document.getElementById('globalModal').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        // ---- Toast ----
        function showToast(title, msg, type = 'default') {
            const icons = { default: 'fa-bell', success: 'fa-check-circle', warning: 'fa-triangle-exclamation' };
            const toast = document.createElement('div');
            toast.className = 'toast toast-' + type;
            toast.innerHTML = `<i class="fa-solid ${icons[type] || icons.default} toast-icon"></i>
        <div class="toast-body">
            <div class="toast-title">${title}</div>
            <div class="toast-msg">${msg}</div>
        </div>`;
            document.getElementById('toastContainer').appendChild(toast);
            setTimeout(() => toast.remove(), 4000);
        }

        // ---- Notifications ----
        function markAllRead() {
            fetch('{{ route("student.notifications.readAll") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            }).then(() => location.reload());
        }
        function readNotif(id) {
            fetch(`/student/notifications/${id}/read`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            }).then(() => location.reload());
        }

        // ---- Countdown Timer ----
        function startCountdown(targetDate, elementId) {
            const el = document.getElementById(elementId);
            if (!el) return;
            function update() {
                const diff = new Date(targetDate) - new Date();
                if (diff <= 0) { el.innerHTML = '<span style="color:var(--red);font-weight:700;">Berakhir</span>'; return; }
                const d = Math.floor(diff / 86400000);
                const h = Math.floor((diff % 86400000) / 3600000);
                const m = Math.floor((diff % 3600000) / 60000);
                const s = Math.floor((diff % 60000) / 1000);
                el.innerHTML = `
            <div class="countdown">
                <div class="countdown-unit"><span class="countdown-num">${String(d).padStart(2, '0')}</span><span class="countdown-lbl">Hari</span></div>
                <div class="countdown-unit"><span class="countdown-num">${String(h).padStart(2, '0')}</span><span class="countdown-lbl">Jam</span></div>
                <div class="countdown-unit"><span class="countdown-num">${String(m).padStart(2, '0')}</span><span class="countdown-lbl">Menit</span></div>
                <div class="countdown-unit"><span class="countdown-num">${String(s).padStart(2, '0')}</span><span class="countdown-lbl">Detik</span></div>
            </div>`;
            }
            update(); setInterval(update, 1000);
        }
    </script>

    @stack('scripts')
</body>

</html>