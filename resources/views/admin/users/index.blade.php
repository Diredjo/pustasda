@extends('layouts.app-admin')
@section('title', $role === 'student' ? 'Data Siswa' : 'Data Guru')
@php $pageTitle = $role === 'student' ? 'Data Siswa' : 'Data Guru'; @endphp

@push('styles')
    <style>
        .toolbar {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 18px;
            align-items: center;
        }

        .data-table .actions {
            display: flex;
            gap: 6px;
        }

        .avatar-sm {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--red), var(--yellow));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .72rem;
            font-weight: 700;
            flex-shrink: 0;
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h1>
            <i class="fa-solid {{ $role === 'student' ? 'fa-user-graduate' : 'fa-chalkboard-teacher' }} text-red"></i>
            {{ $role === 'student' ? 'Data Siswa' : 'Data Guru' }}
        </h1>
        <p>Kelola akun {{ $role === 'student' ? 'siswa' : 'guru' }} PUSTASDA</p>
    </div>

    <div class="toolbar">
        <form method="GET" style="display:flex;gap:8px;flex:1;">
            <input type="hidden" name="role" value="{{ $role }}">
            <div class="search-box" style="max-width:280px;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / email...">
            </div>
            <select name="status" class="form-control" style="width:auto;padding:8px 12px;font-size:.82rem;">
                <option value="">Semua Status</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
            @if(request('search') || request('status') !== null)
                <a href="{{ route('admin.users.index', ['role' => $role]) }}" class="btn btn-secondary btn-sm">
                    <i class="fa-solid fa-xmark"></i> Reset
                </a>
            @endif
        </form>
        <a href="{{ route('admin.users.create', ['role' => $role]) }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah {{ $role === 'student' ? 'Siswa' : 'Guru' }}
        </a>
    </div>

    <div class="table-card">
        <div class="table-head">
            <h4>
                <i class="fa-solid {{ $role === 'student' ? 'fa-user-graduate' : 'fa-chalkboard-teacher' }} text-red"></i>
                {{ $users->total() }} {{ $role === 'student' ? 'Siswa' : 'Guru' }} Ditemukan
            </h4>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    @if($role === 'student')
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                    @else
                        <th>NIP</th>
                        <th>Bidang</th>
                        <th>Jabatan</th>
                    @endif
                    <th>No. WA</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                    <tr>
                        <td style="color:var(--gray);font-size:.78rem;">{{ $users->firstItem() + $i }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:9px;">
                                <div class="avatar-sm">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                                <div>
                                    <div style="font-weight:700;">{{ $user->name }}</div>
                                    <div style="font-size:.72rem;color:var(--gray);">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        @if($role === 'student')
                            <td>{{ $user->studentProfile->nis ?? '-' }}</td>
                            <td>{{ $user->studentProfile->kelas ?? '-' }}</td>
                            <td>{{ $user->studentProfile->jurusan ?? '-' }}</td>
                        @else
                            <td style="font-size:.78rem;">{{ $user->teacherProfile->nip ?? '-' }}</td>
                            <td>{{ $user->teacherProfile->bidang_keahlian ?? '-' }}</td>
                            <td>{{ $user->teacherProfile->jabatan ?? '-' }}</td>
                        @endif
                        <td style="font-size:.8rem;">{{ $user->wa_number ?? '-' }}</td>
                        <td>
                            @if($user->is_active)
                                <span class="badge-role" style="background:#d4edda;color:#155724;">Aktif</span>
                            @else
                                <span class="badge-role" style="background:#f8d7da;color:#721c24;">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-secondary" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.users.toggle', $user) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary"
                                        title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i class="fa-solid {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    id="del-user-{{ $user->id }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm" style="background:#fff3f3;color:var(--red);"
                                        onclick="confirmDelete('del-user-{{ $user->id }}')" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center;padding:32px;color:var(--gray);">
                            <i class="fa-solid fa-box-open" style="font-size:1.5rem;margin-bottom:8px;display:block;"></i>
                            Tidak ada data {{ $role === 'student' ? 'siswa' : 'guru' }} ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:14px 18px;">{{ $users->links() }}</div>
    </div>
@endsection