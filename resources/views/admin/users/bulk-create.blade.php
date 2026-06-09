@extends('layouts.app-admin')

@section('title', 'Tambah Banyak ' . ($role === 'student' ? 'Siswa' : 'Guru'))

@php 
    $pageTitle = 'Tambah Banyak ' . ($role === 'student' ? 'Siswa' : 'Guru'); 
@endphp

@section('content')
    <div class="page-header">
        <h1>
            <i class="fa-solid fa-bolt text-red"></i>
            Tambah Banyak {{ $role === 'student' ? 'Siswa' : 'Guru' }}
        </h1>
        <p>Gunakan mode <b>burst</b> untuk menambah akun secara sekaligus.</p>
    </div>

    <div style="max-width:900px;">
        <div class="card">
            <form action="{{ route('admin.users.bulk-preview') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="role" value="{{ $role }}">

                <div class="form-group">
                    <label for="rows">Masukkan data (1 baris = 1 akun)</label>
                    <textarea id="rows" name="rows" class="form-control @error('rows') is-invalid @enderror" rows="10"
                        placeholder="Contoh:&#10;Andi,andi@gmail.com,Password123,62812...,2223001,XII,RPL,2022&#10;Budi,budi@gmail.com,Password123,62813...,2223002,XI,TKJ,2023">{{ old('rows') }}</textarea>

                    @error('rows')
                        <div style="color:var(--red); font-size:.78rem; margin-top:6px;">{{ $message }}</div>
                    @enderror

                    <div style="color:var(--gray); font-size:.82rem; margin-top:6px;">
                        Pisahkan kolom dengan tanda <b>koma</b> (<code>,</code>) atau tab. Spasi di sekitar kolom akan
                        di-trim otomatis.
                    </div>
                </div>

                <div class="divider"></div>

                @if($role === 'student')
                    <div style="margin-bottom:14px;">
                        <div style="font-weight:700; margin-bottom:6px;">
                            <i class="fa-solid fa-user-graduate text-red"></i> Format kolom Siswa
                        </div>
                        <div style="color:var(--gray); font-size:.9rem;">
                            <code>nama,email,password,wa_number,nis,kelas,jurusan,angkatan</code>
                        </div>
                        <div style="color:var(--gray); font-size:.82rem; margin-top:6px;">
                            <ul style="margin:6px 0 0 18px;">
                                <li><b>kelas</b>: X / XI / XII</li>
                                <li><b>jurusan</b>: RPL / TKJ / DKV (Sesuaikan kompetensi di Skomda)</li>
                                <li><b>angkatan</b>: Angka tahun masuk sekolah (misal: 2024)</li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div style="margin-bottom:14px;">
                        <div style="font-weight:700; margin-bottom:6px;">
                            <i class="fa-solid fa-chalkboard-teacher text-red"></i> Format kolom Guru
                        </div>
                        <div style="color:var(--gray); font-size:.9rem;">
                            <code>nama,email,password,wa_number,nip,bidang_keahlian,jabatan</code>
                        </div>
                        <div style="color:var(--gray); font-size:.82rem; margin-top:6px;">
                            <ul style="margin:6px 0 0 18px;">
                                <li><b>nip</b>: Nomor Induk Pegawai (18 digit tanpa spasi)</li>
                                <li><b>bidang_keahlian</b>: Rekayasa Perangkat Lunak, dll.</li>
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="divider"></div>

                <div style="display:flex; gap:8px; align-items:center;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-bolt"></i> Review Burst
                    </button>
                    <a href="{{ route('admin.users.index', ['role' => $role]) }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection