@extends('layouts.app-admin')
@section('title', 'Edit User')
@php $pageTitle = 'Edit ' . $user->name; @endphp

@section('content')
    <div class="page-header">
        <h1><i class="fa-solid fa-user-pen text-red"></i> Edit {{ $user->role === 'student' ? 'Siswa' : 'Guru' }}</h1>
    </div>

    <div style="max-width:680px;">
        <div class="card">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf @method('PUT')

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div class="form-group">
                        <label>Nama Lengkap <span style="color:var(--red);">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        @error('name')<div style="color:var(--red);font-size:.78rem;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email <span style="color:var(--red);">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                            required>
                        @error('email')<div style="color:var(--red);font-size:.78rem;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password Baru <span style="color:var(--gray);font-weight:400;">(kosongkan jika tidak
                                diganti)</span></label>
                        <input type="password" name="password" class="form-control" minlength="6">
                    </div>
                    <div class="form-group">
                        <label>No. WhatsApp</label>
                        <input type="text" name="wa_number" class="form-control"
                            value="{{ old('wa_number', $user->wa_number) }}">
                    </div>
                    <div class="form-group">
                        <label>Status Akun</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="divider"></div>

                @if($user->role === 'student')
                    @php $sp = $user->studentProfile; @endphp
                    <p style="font-weight:700;font-size:.85rem;margin-bottom:12px;"><i
                            class="fa-solid fa-user-graduate text-red"></i> Data Siswa</p>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="text" name="nis" class="form-control" value="{{ old('nis', $sp->nis ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Angkatan</label>
                            <input type="number" name="angkatan" class="form-control"
                                value="{{ old('angkatan', $sp->angkatan ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach(['X', 'XI', 'XII'] as $k)
                                    <option value="{{ $k }}" {{ old('kelas', $sp->kelas ?? '') === $k ? 'selected' : '' }}>{{ $k }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select name="jurusan" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach(['RPL', 'TKJ', 'MM', 'TKR', 'TEI'] as $j)
                                    <option value="{{ $j }}" {{ old('jurusan', $sp->jurusan ?? '') === $j ? 'selected' : '' }}>{{ $j }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    @php $tp = $user->teacherProfile; @endphp
                    <p style="font-weight:700;font-size:.85rem;margin-bottom:12px;"><i
                            class="fa-solid fa-chalkboard-teacher text-red"></i> Data Guru</p>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="{{ old('nip', $tp->nip ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" class="form-control"
                                value="{{ old('jabatan', $tp->jabatan ?? '') }}">
                        </div>
                        <div class="form-group" style="grid-column:span 2;">
                            <label>Bidang Keahlian</label>
                            <input type="text" name="bidang_keahlian" class="form-control"
                                value="{{ old('bidang_keahlian', $tp->bidang_keahlian ?? '') }}">
                        </div>
                    </div>
                @endif

                <div style="display:flex;gap:8px;margin-top:8px;">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Perbarui</button>
                    <a href="{{ route('admin.users.index', ['role' => $user->role]) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection