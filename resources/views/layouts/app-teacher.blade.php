<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Guru')</title>
    <link rel="icon" href="{{ asset('images/iconappround.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>

<body>
    <div class="app-layout">
        @php $pageTitle = $pageTitle ?? 'Dashboard Guru'; @endphp
        @include('layouts.navbar', ['pageTitle' => $pageTitle])
        <div class="app-body">
            @include('layouts.sidebar-teacher')
            <main class="main-content">
                @if(session('success'))
                    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    <div class="toast-container" id="toastContainer"></div>
    <div class="modal-overlay" id="globalModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="globalModalTitle">-</h3>
                <button class="modal-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div id="globalModalBody"></div>
        </div>
    </div>
    <script>
        document.getElementById('btnAvatar').addEventListener('click', function (e) {
            e.stopPropagation();
            document.getElementById('notifPanel').classList.remove('open');
            document.getElementById('avatarDropdown').classList.toggle('open');
        });
        document.getElementById('btnNotif').addEventListener('click', function (e) {
            e.stopPropagation();
            document.getElementById('avatarDropdown').classList.remove('open');
            document.getElementById('notifPanel').classList.toggle('open');
        });
        document.addEventListener('click', function () {
            document.getElementById('avatarDropdown').classList.remove('open');
            document.getElementById('notifPanel').classList.remove('open');
        });
        function openModal(title, bodyHtml) {
            document.getElementById('globalModalTitle').textContent = title;
            document.getElementById('globalModalBody').innerHTML = bodyHtml;
            document.getElementById('globalModal').classList.add('open');
        }
        function closeModal() { document.getElementById('globalModal').classList.remove('open'); }
        document.getElementById('globalModal').addEventListener('click', function (e) { if (e.target === this) closeModal(); });
        function showToast(title, msg, type = 'default') {
            const t = document.createElement('div');
            t.className = 'toast toast-' + type;
            t.innerHTML = `<i class="fa-solid fa-bell toast-icon"></i><div class="toast-body"><div class="toast-title">${title}</div><div class="toast-msg">${msg}</div></div>`;
            document.getElementById('toastContainer').appendChild(t);
            setTimeout(() => t.remove(), 4000);
        }
        function markAllRead() {
            fetch('{{ route("teacher.notifications.readAll") }}', {
                method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => location.reload());
        }
        function readNotif(id) {
            fetch(`/teacher/notifications/${id}/read`, {
                method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => location.reload());
        }
    </script>
    @stack('scripts')
</body>

</html>