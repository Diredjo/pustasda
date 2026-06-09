@extends('layouts.app-admin')

@section('title', 'Preview Burst ' . ($role === 'student' ? 'Siswa' : 'Guru'))

@php 
    $pageTitle = 'Preview Burst ' . ($role === 'student' ? 'Siswa' : 'Guru'); 
@endphp

@section('content')
    <div class="page-header">
        <h1>
            <i class="fa-solid fa-eye text-red"></i> 
            Preview Burst {{ $role === 'student' ? 'Siswa' : 'Guru' }}
        </h1>
        <p>Data akan dibuat sesuai baris input.</p>
    </div>

    <div style="max-width:1000px;">
        <div class="card">
            <form method="POST" action="{{ route('admin.users.bulk-store') }}">
                @csrf
                <input type="hidden" name="role" value="{{ $role }}">
                <input type="hidden" name="rows" value="{{ old('rows', $rowsRaw ?? '') }}">

                <div style="overflow:auto; margin-bottom: 20px;">
                    <table class="data-table" style="width:100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr style="background: var(--light-gray); border-bottom: 2px solid var(--border-color);">
                                <th style="padding: 10px; width: 40px;">#</th>
                                <th style="padding: 10px;">Nama</th>
                                <th style="padding: 10px;">Email</th>
                                <th style="padding: 10px;">WA</th>
                                @if($role === 'student')
                                    <th style="padding: 10px;">NIS</th>
                                    <th style="padding: 10px;">Kelas</th>
                                    <th style="padding: 10px;">Jurusan</th>
                                    <th style="padding: 10px;">Angkatan</th>
                                @else
                                    <th style="padding: 10px;">NIP</th>
                                    <th style="padding: 10px;">Bidang</th>
                                    <th style="padding: 10px;">Jabatan</th>
                                @endif
                                <th style="padding: 10px; width: 180px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($parsed ?? [] as $i => $item)
                                @php
                                    $itemErrors = data_get($item, 'errors');
                                    $status = $itemErrors ? 'Gagal' : 'Siap';
                                    $color = $itemErrors ? '#f8d7da' : '#d4edda';
                                    $textColor = $itemErrors ? '#721c24' : '#155724';
                                @endphp
                                <tr style="border-bottom: 1px solid var(--border-color);">
                                    <td style="padding: 10px; color:var(--gray); font-size:.78rem;">{{ $i + 1 }}</td>
                                    <td style="padding: 10px;">{{ data_get($item, 'name') ?: '-' }}</td>
                                    <td style="padding: 10px; font-size:.84rem;"><code>{{ data_get($item, 'email') ?: '-' }}</code></td>
                                    <td style="padding: 10px;">{{ data_get($item, 'wa_number') ?: '-' }}</td>
                                    
                                    @if($role === 'student')
                                        <td style="padding: 10px;">{{ data_get($item, 'nis') ?: '-' }}</td>
                                        <td style="padding: 10px;"><span class="badge badge-info">{{ data_get($item, 'kelas') ?: '-' }}</span></td>
                                        <td style="padding: 10px;"><b>{{ data_get($item, 'jurusan') ?: '-' }}</b></td>
                                        <td style="padding: 10px;">{{ data_get($item, 'angkatan') ?: '-' }}</td>
                                    @else
                                        <td style="padding: 10px;">{{ data_get($item, 'nip') ?: '-' }}</td>
                                        <td style="padding: 10px;">{{ data_get($item, 'bidang_keahlian') ?: '-' }}</td>
                                        <td style="padding: 10px;">{{ data_get($item, 'jabatan') ?: '-' }}</td>
                                    @endif
                                    
                                    <td style="padding: 10px;">
                                        <span class="badge-role" style="background:{{ $color }}; color:{{ $textColor }}; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold; display: inline-block;">
                                            {{ $status }}
                                        </span>
                                        @if($itemErrors)
                                            <div style="margin-top:6px; color:var(--red); font-size:.78rem;">
                                                <ul style="margin:0; padding-left:16px; list-style-type: disc;">
                                                    @foreach($itemErrors as $e)
                                                        <li>{{ $e }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $role === 'student' ? 9 : 8 }}" style="padding: 20px; text-align: center; color: var(--gray);">
                                        Tidak ada data yang tersedia untuk ditampilkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="display:flex; gap:8px; align-items:center; margin-top:14px;">
                    <button type="submit" class="btn btn-primary" @if(empty($parsed)) disabled @endif>
                        <i class="fa-solid fa-bolt"></i> Konfirmasi Tambah Burst (skip yang gagal)
                    </button>
                    <a href="{{ route('admin.users.burst', ['role' => $role]) }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection