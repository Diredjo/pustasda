@extends('layouts.app-admin')
@section('title','Bidang Lomba')
@php $pageTitle = 'Bidang Lomba'; @endphp

@section('content')
<div class="page-header">
    <h1><i class="fa-solid fa-layer-group text-red"></i> Bidang Lomba</h1>
</div>

<div style="display:grid;grid-template-columns:340px 1fr;gap:20px;">
    <div class="card" id="fieldFormCard">
        <h4 style="font-weight:800;margin-bottom:16px;" id="fieldFormTitle">
            <i class="fa-solid fa-plus text-red"></i> Tambah Bidang
        </h4>
        <form method="POST" id="fieldForm" action="{{ route('admin.fields.store') }}">
            @csrf
            <div id="fieldMethodField"></div>
            <div class="form-group">
                <label>Nama Bidang <span style="color:var(--red);">*</span></label>
                <input type="text" name="name" id="fieldName" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Icon FontAwesome</label>
                <div style="display:flex;gap:8px;align-items:center;">
                    <input type="text" name="icon" id="fieldIcon" class="form-control" value="fa-star"
                           oninput="document.getElementById('fieldIconPreview').className='fa-solid '+this.value">
                    <div style="width:36px;height:36px;background:var(--gray-light);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                        <i class="fa-solid fa-star text-gray" id="fieldIconPreview"></i>
                    </div>
                </div>
            </div>
            <div style="display:flex;gap:8px;">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="resetFieldForm()">Reset</button>
            </div>
        </form>
    </div>

    <div class="table-card">
        <div class="table-head">
            <h4><i class="fa-solid fa-layer-group text-red"></i> {{ $fields->count() }} Bidang</h4>
        </div>
        <table class="data-table">
            <thead><tr><th>Nama Bidang</th><th>Icon</th><th>Lomba</th><th>Aksi</th></tr></thead>
            <tbody>
            @foreach($fields as $f)
            <tr>
                <td style="font-weight:700;">{{ $f->name }}</td>
                <td><i class="fa-solid {{ $f->icon }}" style="font-size:1.1rem;color:var(--gray);"></i> <span style="font-size:.75rem;color:var(--gray);">{{ $f->icon }}</span></td>
                <td style="font-weight:700;color:var(--red);">{{ $f->competitions_count }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <button class="btn btn-sm btn-secondary"
                                onclick="editField({{ $f->id }},'{{ addslashes($f->name) }}','{{ $f->icon }}')">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.fields.destroy', $f) }}" id="del-field-{{ $f->id }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm" style="background:#fff3f3;color:var(--red);"
                                    onclick="confirmDelete('del-field-{{ $f->id }}')"
                                    {{ $f->competitions_count > 0 ? 'disabled title=\'Masih digunakan\'' : '' }}>
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
function editField(id, name, icon) {
    document.getElementById('fieldFormTitle').innerHTML = '<i class="fa-solid fa-pen text-red"></i> Edit Bidang';
    document.getElementById('fieldName').value = name;
    document.getElementById('fieldIcon').value = icon;
    document.getElementById('fieldIconPreview').className = 'fa-solid ' + icon + ' text-gray';
    document.getElementById('fieldForm').action = `/admin/fields/${id}`;
    document.getElementById('fieldMethodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
}
function resetFieldForm() {
    document.getElementById('fieldFormTitle').innerHTML = '<i class="fa-solid fa-plus text-red"></i> Tambah Bidang';
    document.getElementById('fieldForm').reset();
    document.getElementById('fieldForm').action = '{{ route("admin.fields.store") }}';
    document.getElementById('fieldMethodField').innerHTML = '';
}
</script>
@endpush