@extends('layouts.app-admin')
@section('title', 'Kategori')
@php $pageTitle = 'Kategori Lomba'; @endphp

@section('content')
    <div class="page-header">
        <h1><i class="fa-solid fa-tags text-red"></i> Kategori Lomba</h1>
    </div>

    <div style="display:grid;grid-template-columns:380px 1fr;gap:20px;">

        {{-- Form Tambah / Edit --}}
        <div class="card" id="formCard">
            <h4 style="font-weight:800;margin-bottom:16px;" id="formTitle">
                <i class="fa-solid fa-plus text-red"></i> Tambah Kategori
            </h4>
            <form method="POST" id="catForm" action="{{ route('admin.categories.store') }}">
                @csrf
                <div id="methodField"></div>
                <div class="form-group">
                    <label>Nama Kategori <span style="color:var(--red);">*</span></label>
                    <input type="text" name="name" id="catName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Icon FontAwesome <span style="color:var(--gray);font-weight:400;">(class name)</span></label>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <input type="text" name="icon" id="catIcon" class="form-control" value="fa-trophy"
                            oninput="document.getElementById('iconPreview').className='fa-solid '+this.value">
                        <div
                            style="width:36px;height:36px;background:var(--red-light);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-solid fa-trophy text-red" id="iconPreview"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Warna</label>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <input type="color" name="color" id="catColor" value="#e31e25"
                            style="width:48px;height:36px;padding:2px;border:1.5px solid var(--gray-mid);border-radius:8px;cursor:pointer;">
                        <span style="font-size:.8rem;color:var(--gray);">Warna label kategori</span>
                    </div>
                </div>
                <div style="display:flex;gap:8px;">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="resetCatForm()">Reset</button>
                </div>
            </form>
        </div>

        {{-- Tabel --}}
        <div class="table-card">
            <div class="table-head">
                <h4><i class="fa-solid fa-tags text-red"></i> {{ $categories->count() }} Kategori</h4>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Icon</th>
                        <th>Warna</th>
                        <th>Lomba</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                        <tr>
                            <td style="font-weight:700;">{{ $cat->name }}</td>
                            <td><i class="fa-solid {{ $cat->icon }}" style="color:{{ $cat->color }};font-size:1.1rem;"></i></td>
                            <td>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <div style="width:20px;height:20px;border-radius:5px;background:{{ $cat->color }};"></div>
                                    <span style="font-size:.78rem;font-family:monospace;">{{ $cat->color }}</span>
                                </div>
                            </td>
                            <td style="font-weight:700;color:var(--red);">{{ $cat->competitions_count }}</td>
                            <td>
                                <div style="display:flex;gap:6px;">
                                    <button class="btn btn-sm btn-secondary"
                                        onclick="editCat({{ $cat->id }},'{{ addslashes($cat->name) }}','{{ $cat->icon }}','{{ $cat->color }}')">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}"
                                        id="del-cat-{{ $cat->id }}" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm" style="background:#fff3f3;color:var(--red);"
                                            onclick="confirmDelete('del-cat-{{ $cat->id }}')" {{ $cat->competitions_count > 0 ? 'disabled title=\'Ada lomba memakai kategori ini\'' : '' }}>
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function editCat(id, name, icon, color) {
            document.getElementById('formTitle').innerHTML = '<i class="fa-solid fa-pen text-red"></i> Edit Kategori';
            document.getElementById('catName').value = name;
            document.getElementById('catIcon').value = icon;
            document.getElementById('catColor').value = color;
            document.getElementById('iconPreview').className = 'fa-solid ' + icon;
            document.getElementById('catForm').action = `/admin/categories/${id}`;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('formCard').scrollIntoView({ behavior: 'smooth' });
        }
        function resetCatForm() {
            document.getElementById('formTitle').innerHTML = '<i class="fa-solid fa-plus text-red"></i> Tambah Kategori';
            document.getElementById('catForm').reset();
            document.getElementById('catForm').action = '{{ route("admin.categories.store") }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('iconPreview').className = 'fa-solid fa-trophy text-red';
        }
    </script>
@endpush