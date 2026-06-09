@extends('layouts.app-admin')
@section('title', 'Data Lomba')
@php $pageTitle = 'Data Lomba'; @endphp

@section('content')
    <div class="page-header">
        <h1><i class="fa-solid fa-trophy text-red"></i> Data Lomba</h1>
        <p>Kelola semua lomba di PUSTASDA</p>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:18px;align-items:center;">
        <form method="GET" style="display:flex;gap:8px;flex:1;flex-wrap:wrap;">
            <div class="search-box" style="max-width:260px;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul / penyelenggara...">
            </div>
            <select name="level" class="form-control" style="width:auto;padding:8px 12px;font-size:.82rem;">
                <option value="">Semua Level</option>
                @foreach(['sekolah', 'kota', 'provinsi', 'nasional', 'internasional'] as $lv)
                    <option value="{{ $lv }}" {{ request('level') === $lv ? 'selected' : '' }}>{{ ucfirst($lv) }}</option>
                @endforeach
            </select>
            <select name="type" class="form-control" style="width:auto;padding:8px 12px;font-size:.82rem;">
                <option value="">Semua Tipe</option>
                <option value="solo" {{ request('type') === 'solo' ? 'selected' : '' }}>Solo</option>
                <option value="team" {{ request('type') === 'team' ? 'selected' : '' }}>Tim</option>
            </select>
            <select name="status" class="form-control" style="width:auto;padding:8px 12px;font-size:.82rem;">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
            @if(request()->anyFilled(['search', 'level', 'type', 'status']))
                <a href="{{ route('admin.competitions.index') }}" class="btn btn-secondary btn-sm"><i
                        class="fa-solid fa-xmark"></i></a>
            @endif
        </form>
        <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah Lomba
        </a>
    </div>

    <div class="table-card">
        <div class="table-head">
            <h4><i class="fa-solid fa-trophy text-red"></i> {{ $competitions->total() }} Lomba</h4>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Lomba</th>
                    <th>Level</th>
                    <th>Tipe</th>
                    <th>Deadline</th>
                    <th>Partisipan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($competitions as $i => $c)
                    @php
                        $lvl = ['nasional' => 'level-nasional', 'provinsi' => 'level-provinsi', 'kota' => 'level-kota', 'internasional' => 'level-internasional', 'sekolah' => 'level-sekolah'];
                    @endphp
                    <tr>
                        <td style="color:var(--gray);font-size:.78rem;">{{ $competitions->firstItem() + $i }}</td>
                        <td>
                            <div style="font-weight:700;max-width:280px;">{{ Str::limit($c->title, 45) }}</div>
                            <div style="font-size:.72rem;color:var(--gray);">{{ $c->organizer }}</div>
                            @if($c->is_trending)
                                <span
                                    style="font-size:.62rem;background:var(--red);color:#fff;padding:1px 6px;border-radius:10px;margin-top:2px;display:inline-block;">
                                    <i class="fa-solid fa-fire"></i> Trending
                                </span>
                            @endif
                        </td>
                        <td><span class="comp-tag {{ $lvl[$c->level] ?? '' }}">{{ ucfirst($c->level) }}</span></td>
                        <td><span
                                class="comp-tag {{ $c->type === 'team' ? 'type-team' : 'type-solo' }}">{{ $c->type === 'team' ? 'Tim' : 'Solo' }}</span>
                        </td>
                        <td style="font-size:.8rem;">
                            {{ $c->deadline->format('d M Y') }}
                            @if($c->deadline->isPast())
                                <div style="font-size:.7rem;color:#721c24;">Berakhir</div>
                            @elseif($c->deadline->diffInDays(now()) <= 7)
                                <div style="font-size:.7rem;color:#856404;">Segera berakhir</div>
                            @endif
                        </td>
                        <td style="font-weight:700;color:var(--red);">{{ $c->participations()->count() }}</td>
                        <td>
                            @if($c->is_active)
                                <span class="badge-role" style="background:#d4edda;color:#155724;">Aktif</span>
                            @else
                                <span class="badge-role" style="background:#f8d7da;color:#721c24;">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.competitions.edit', $c) }}" class="btn btn-sm btn-secondary"
                                    title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.competitions.toggle', $c) }}"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary"
                                        title="{{ $c->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i class="fa-solid {{ $c->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.competitions.destroy', $c) }}"
                                    id="del-comp-{{ $c->id }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm" style="background:#fff3f3;color:var(--red);"
                                        onclick="confirmDelete('del-comp-{{ $c->id }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:32px;color:var(--gray);">
                            <i class="fa-solid fa-box-open" style="font-size:1.5rem;margin-bottom:8px;display:block;"></i>
                            Tidak ada lomba ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:14px 18px;">{{ $competitions->links() }}</div>
    </div>
@endsection