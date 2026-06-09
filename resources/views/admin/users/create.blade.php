@extends('layouts.app-admin')
@section('title', 'Tambah ' . ($role === 'student' ? 'Siswa' : 'Guru'))
@php $pageTitle = 'Tambah ' . ($role === 'student' ? 'Siswa' : 'Guru'); @endphp

@section('content')
    <div class="page-header">
        <h1><i class="fa-solid fa-user-plus text-red"></i> Tambah {{ $role === 'student' ? 'Siswa' : 'Guru' }}</h1>
    </div>

    <div style="max-width:680px;">
        <div class="card">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <input type="hidden" name="role" value="{{ $role }}">

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div class="form-group">
                        <label>Nama Lengkap <span style="color:var(--red);">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" required>
                        @error('name')<div style="color:var(--red);font-size:.78rem;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email <span style="color:var(--red);">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required>
                        @error('email')<div style="color:var(--red);font-size:.78rem;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password <span style="color:var(--red);">*</span></label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                        @error('password')<div style="color:var(--red);font-size:.78rem;margin-top:4px;">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group">
                        <label>No. WhatsApp</label>
                        <input type="text" name="wa_number" class="form-control" value="{{ old('wa_number') }}"
                            placeholder="628xxxxxxxxxx">
                    </div>
                </div>

                <div class="divider"></div>

                @if($role === 'student')
                    <p style="font-weight:700;font-size:.85rem;margin-bottom:12px;"><i
                            class="fa-solid fa-user-graduate text-red"></i> Data Siswa</p>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="text" name="nis" class="form-control" value="{{ old('nis') }}">
                        </div>
                        <div class="form-group">
                            <label>Angkatan</label>
                            <input type="number" name="angkatan" class="form-control" value="{{ old('angkatan') }}" min="2000"
                                max="2099">
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="X" {{ old('kelas') === 'X' ? 'selected' : '' }}>X</option>
                                <option value="XI" {{ old('kelas') === 'XI' ? 'selected' : '' }}>XI</option>
                                <option value="XII" {{ old('kelas') === 'XII' ? 'selected' : '' }}>XII</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select name="jurusan" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="RPL">RPL</option>
                                <option value="TKJ">TKJ</option>
                                <option value="MM">Multimedia</option>
                                <option value="TKR">TKR</option>
                                <option value="TEI">TEI</option>
                            </select>
                        </div>
                    </div>
                @else
                    <p style="font-weight:700;font-size:.85rem;margin-bottom:12px;"><i
                            class="fa-solid fa-chalkboard-teacher text-red"></i> Data Guru</p>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="{{ old('nip') }}">
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}"
                                placeholder="Guru Produktif RPL">
                        </div>
                        <div class="form-group" style="grid-column:span 2;">
                            <label>Bidang Keahlian</label>
                            <input type="text" name="bidang_keahlian" class="form-control" value="{{ old('bidang_keahlian') }}"
                                placeholder="Rekayasa Perangkat Lunak">
                        </div>
                    </div>
                @endif

                <div style="display:flex;gap:8px;margin-top:8px;">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                    <a href="{{ route('admin.users.index', ['role' => $role]) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection