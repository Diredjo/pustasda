@push('styles')
    <style>
        .form-section {
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            padding: 24px;
            margin-bottom: 18px;
        }

        .form-section-title {
            font-weight: 800;
            font-size: .9rem;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--dark);
            padding-bottom: 10px;
            border-bottom: 1px solid var(--gray-mid);
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 14px;
        }

        .stage-row {
            background: var(--gray-light);
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 10px;
        }
    </style>
@endpush

{{-- INFO DASAR --}}
<div class="form-section">
    <div class="form-section-title"><i class="fa-solid fa-circle-info text-red"></i> Informasi Dasar</div>
    <div class="form-group">
        <label>Judul Lomba <span style="color:var(--red);">*</span></label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $competition->title ?? '') }}"
            required>
        @error('title')<div style="color:var(--red);font-size:.78rem;margin-top:4px;">{{ $message }}</div>@enderror
    </div>
    <div class="form-grid-2">
        <div class="form-group">
            <label>Penyelenggara <span style="color:var(--red);">*</span></label>
            <input type="text" name="organizer" class="form-control"
                value="{{ old('organizer', $competition->organizer ?? '') }}" required>
        </div>
        <div class="form-group">
            <label>Link Pendaftaran</label>
            <input type="url" name="link_registration" class="form-control"
                value="{{ old('link_registration', $competition->link_registration ?? '') }}" placeholder="https://...">
        </div>
        <div class="form-group">
            <label>Link Guidebook</label>
            <input type="url" name="guidebook_link" class="form-control"
                value="{{ old('guidebook_link', $competition->guidebook_link ?? '') }}" placeholder="https://...">
        </div>
        <div class="form-group">
            <label>Kategori <span style="color:var(--red);">*</span></label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $competition->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Bidang <span style="color:var(--red);">*</span></label>
            <select name="field_id" class="form-control" required>
                <option value="">-- Pilih Bidang --</option>
                @foreach($fields as $f)
                    <option value="{{ $f->id }}" {{ old('field_id', $competition->field_id ?? '') == $f->id ? 'selected' : '' }}>
                        {{ $f->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control"
            rows="4">{{ old('description', $competition->description ?? '') }}</textarea>
    </div>
    <div class="form-group">
        <label>Ketentuan / Persyaratan</label>
        <textarea name="requirements" class="form-control"
            rows="4">{{ old('requirements', $competition->requirements ?? '') }}</textarea>
    </div>
</div>

{{-- KONFIGURASI --}}
<div class="form-section">
    <div class="form-section-title"><i class="fa-solid fa-sliders text-red"></i> Konfigurasi Lomba</div>
    <div class="form-grid-3">
        <div class="form-group">
            <label>Level <span style="color:var(--red);">*</span></label>
            <select name="level" class="form-control" required>
                <option value="">-- Pilih Level --</option>
                @foreach(['sekolah', 'kota', 'provinsi', 'nasional', 'internasional'] as $lv)
                    <option value="{{ $lv }}" {{ old('level', $competition->level ?? '') === $lv ? 'selected' : '' }}>
                        {{ ucfirst($lv) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tipe <span style="color:var(--red);">*</span></label>
            <select name="type" class="form-control" id="typeSelect" required onchange="toggleTeamFields()">
                <option value="solo" {{ old('type', $competition->type ?? '') === 'solo' ? 'selected' : '' }}>Solo / Mandiri
                </option>
                <option value="team" {{ old('type', $competition->type ?? '') === 'team' ? 'selected' : '' }}>Tim / Kelompok
                </option>
            </select>
        </div>
        <div class="form-group">
            <label>Jumlah Tahap <span style="color:var(--red);">*</span></label>
            <input type="number" name="total_stages" id="totalStages" class="form-control"
                value="{{ old('total_stages', $competition->total_stages ?? 1) }}" min="1" max="10" required
                onchange="updateStages()">
        </div>
        <div class="form-group" id="minMemberWrap"
            style="{{ old('type', $competition->type ?? 'solo') === 'solo' ? 'display:none;' : '' }}">
            <label>Min. Anggota Tim</label>
            <input type="number" name="min_members" class="form-control"
                value="{{ old('min_members', $competition->min_members ?? 1) }}" min="1">
        </div>
        <div class="form-group" id="maxMemberWrap"
            style="{{ old('type', $competition->type ?? 'solo') === 'solo' ? 'display:none;' : '' }}">
            <label>Maks. Anggota Tim</label>
            <input type="number" name="max_members" class="form-control"
                value="{{ old('max_members', $competition->max_members ?? 1) }}" min="1">
        </div>
        <div class="form-group">
            <label>Trending?</label>
            <select name="is_trending" class="form-control">
                <option value="0" {{ !old('is_trending', $competition->is_trending ?? false) ? 'selected' : '' }}>Tidak
                </option>
                <option value="1" {{ old('is_trending', $competition->is_trending ?? false) ? 'selected' : '' }}>Ya —
                    Tampilkan di Trending</option>
            </select>
        </div>
        @if($competition)
            <div class="form-group">
                <label>Status Lomba</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ $competition->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$competition->is_active ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        @endif
    </div>
</div>

{{-- TANGGAL --}}
<div class="form-section">
    <div class="form-section-title"><i class="fa-solid fa-calendar-alt text-red"></i> Tanggal Penting</div>
    <div class="form-grid-3">
        <div class="form-group">
            <label>Deadline Pendaftaran</label>
            <input type="date" name="register_deadline" class="form-control"
                value="{{ old('register_deadline', isset($competition) && $competition->register_deadline ? $competition->register_deadline->format('Y-m-d') : '') }}">
        </div>
        <div class="form-group">
            <label>Deadline Submit <span style="color:var(--red);">*</span></label>
            <input type="date" name="deadline" class="form-control" required
                value="{{ old('deadline', isset($competition) && $competition->deadline ? $competition->deadline->format('Y-m-d') : '') }}">
        </div>
        <div class="form-group">
            <label>Tanggal Pengumuman</label>
            <input type="date" name="announcement_date" class="form-control"
                value="{{ old('announcement_date', isset($competition) && $competition->announcement_date ? $competition->announcement_date->format('Y-m-d') : '') }}">
        </div>
    </div>
</div>

{{-- STAGES --}}
<div class="form-section" id="stagesSection"
    style="{{ old('total_stages', $competition->total_stages ?? 1) <= 1 ? 'display:none;' : '' }}">
    <div class="form-section-title"><i class="fa-solid fa-layer-group text-red"></i> Tahapan Lomba</div>
    <div id="stagesContainer">
        @php $stages = $competition->stages ?? collect(); @endphp
        @for($i = 0; $i < max(old('total_stages', $competition->total_stages ?? 1), 1); $i++)
            @php $stage = $stages[$i] ?? null; @endphp
            <div class="stage-row">
                <div style="font-weight:700;font-size:.82rem;margin-bottom:10px;color:var(--red);">
                    <i class="fa-solid fa-circle-{{ $i + 1 <= 9 ? $i + 1 : 'dot' }}"></i> Tahap {{ $i + 1 }}
                </div>
                <div class="form-grid-3">
                    <div class="form-group" style="grid-column:span 1;">
                        <label>Nama Tahap</label>
                        <input type="text" name="stage_name[]" class="form-control"
                            value="{{ old('stage_name.' . $i, $stage->stage_name ?? '') }}"
                            placeholder="cth: Seleksi Administrasi">
                    </div>
                    <div class="form-group">
                        <label>Deadline Tahap</label>
                        <input type="date" name="stage_deadline[]" class="form-control"
                            value="{{ old('stage_deadline.' . $i, isset($stage) && $stage->deadline ? $stage->deadline->format('Y-m-d') : '') }}">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Singkat</label>
                        <input type="text" name="stage_desc[]" class="form-control"
                            value="{{ old('stage_desc.' . $i, $stage->description ?? '') }}" placeholder="Penjelasan singkat">
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

{{-- MEDIA --}}
<div class="form-section">
    <div class="form-section-title"><i class="fa-solid fa-image text-red"></i> Poster & Cover</div>
    <div class="form-grid-2">
        <div class="form-group">
            <label>Poster Lomba <span style="color:var(--gray);font-weight:400;">(maks. 2MB)</span></label>
            <input type="file" name="poster" class="form-control" accept="image/*"
                onchange="previewImg(this,'prevPoster')">
            @if(isset($competition) && $competition->poster)
                <img id="prevPoster" src="{{ asset('storage/' . $competition->poster) }}"
                    style="margin-top:8px;max-height:100px;border-radius:8px;">
            @else
                <img id="prevPoster" style="display:none;margin-top:8px;max-height:100px;border-radius:8px;">
            @endif
        </div>
        <div class="form-group">
            <label>Cover / Banner <span style="color:var(--gray);font-weight:400;">(maks. 2MB)</span></label>
            <input type="file" name="cover" class="form-control" accept="image/*"
                onchange="previewImg(this,'prevCover')">
            @if(isset($competition) && $competition->cover)
                <img id="prevCover" src="{{ asset('storage/' . $competition->cover) }}"
                    style="margin-top:8px;max-height:100px;border-radius:8px;">
            @else
                <img id="prevCover" style="display:none;margin-top:8px;max-height:100px;border-radius:8px;">
            @endif
        </div>
    </div>
</div>

<div style="display:flex;gap:8px;">
    <button type="submit" class="btn btn-primary btn-lg">
        <i class="fa-solid fa-save"></i> {{ isset($competition) ? 'Perbarui Lomba' : 'Simpan Lomba' }}
    </button>
    <a href="{{ route('admin.competitions.index') }}" class="btn btn-secondary btn-lg">Batal</a>
</div>

@push('scripts')
    <script>
        function toggleTeamFields() {
            const isTeam = document.getElementById('typeSelect').value === 'team';
            document.getElementById('minMemberWrap').style.display = isTeam ? '' : 'none';
            document.getElementById('maxMemberWrap').style.display = isTeam ? '' : 'none';
            if (!isTeam) {
                document.querySelector('[name=min_members]').value = 1;
                document.querySelector('[name=max_members]').value = 1;
            }
        }
        function updateStages() {
            const n = parseInt(document.getElementById('totalStages').value) || 1;
            document.getElementById('stagesSection').style.display = n > 1 ? '' : 'none';
            const container = document.getElementById('stagesContainer');
            // Tambah baris stage kalau kurang
            const existing = container.querySelectorAll('.stage-row').length;
            for (let i = existing; i < n; i++) {
                container.insertAdjacentHTML('beforeend', `
                <div class="stage-row">
                    <div style="font-weight:700;font-size:.82rem;margin-bottom:10px;color:var(--red);">
                        <i class="fa-solid fa-circle-dot"></i> Tahap ${i + 1}
                    </div>
                    <div class="form-grid-3">
                        <div class="form-group"><label>Nama Tahap</label>
                            <input type="text" name="stage_name[]" class="form-control" placeholder="Nama tahap ${i + 1}"></div>
                        <div class="form-group"><label>Deadline</label>
                            <input type="date" name="stage_deadline[]" class="form-control"></div>
                        <div class="form-group"><label>Deskripsi</label>
                            <input type="text" name="stage_desc[]" class="form-control"></div>
                    </div>
                </div>`);
            }
            // Hapus kelebihan
            const rows = container.querySelectorAll('.stage-row');
            for (let i = rows.length - 1; i >= n; i--) rows[i].remove();
        }
        function previewImg(input, targetId) {
            const img = document.getElementById(targetId);
            if (input.files && input.files[0]) {
                img.src = URL.createObjectURL(input.files[0]);
                img.style.display = 'block';
            }
        }
    </script>
@endpush