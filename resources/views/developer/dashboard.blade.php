<h1>Halaman Developer sedang dalam perbaikan</h1>
<a href="{{ route('logout') }}"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>