@extends('layouts.app-teacher')
@section('title', 'Detail Bimbingan')
@php $pageTitle = 'Detail Bimbingan'; @endphp

@section('content')
    @php
        $siswa = $mentorship->participation->user;
        $comp = $mentorship->participation->competition;
        $part = $mentorship->participation;
        $steps = $part->steps;
        $resultMap = ['juara_1' => '🥇 Juara 1', 'juara_2' => '🥈 Juara 2', 'juara_3' => '🥉 Juara 3', 'juara_harapan' => 'Juara Harapan', 'favorit' => 'Favorit', 'terpilih' => 'Terpilih', 'lolos_tahap' => 'Lolos Tahap', 'tidak_lolos' => 'Tidak Lolos', 'belum_diisi' => 'Belum Diisi'];
    @endphp

    <div style="display:grid;grid-template-columns:1fr 340px;gap:20px;max-width:1000px;">

        {{-- Kiri: Info Lomba + Progres --}}
        <div>
            <div class="card" style="margin-bottom:16px;">
                <div style="display:flex;align-items:flex-start;gap:14px;margin-bottom:14px;">
                    <div
                        style="width:52px;height:52px;border-radius:12px;background:var(--red-light);display:flex;align-items:center;justify-content:center;color:var(--red);font-size:1.3rem;flex-shrink:0;">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <div>
                        <h2 style="font-size:1.05rem;font-weight:800;margin-bottom:4px;">{{ $comp->title }}</h2>
                        <div style="font-size:.8rem;color:var(--gray);">
                            <i class="fa-solid fa-building"></i> {{ $comp->organizer }}
                            &bull;
                            <span
                                class="comp-tag {{ match ($comp->level) { 'nasional' => 'level-nasional', 'provinsi' => 'level-provinsi', 'kota' => 'level-kota', default => ''} }}">{{ ucfirst($comp->level) }}</span>
                        </div>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;font-size:.82rem;">
                    <div style="padding:10px;background:var(--gray-light);border-radius:8px;">
                        <div style="color:var(--gray);font-size:.72rem;margin-bottom:2px;">Deadline</div>
                        <div style="font-weight:700;">{{ $comp->deadline->format('d M Y') }}</div>
                    </div>
                    <div style="padding:10px;background:var(--gray-light);border-radius:8px;">
                        <div style="color:var(--gray);font-size:.72rem;margin-bottom:2px;">Status Partisipasi</div>
                        <div style="font-weight:700;">{{ ucfirst(str_replace('_', ' ', $part->status)) }}</div>
                    </div>
                    <div style="padding:10px;background:var(--gray-light);border-radius:8px;grid-column:span 2;">
                        <div style="color:var(--gray);font-size:.72rem;margin-bottom:2px;">Hasil Akhir</div>
                        <div style="font-weight:700;font-size:.95rem;">{{ $resultMap[$part->result] ?? $part->result }}
                        </div>
                    </div>
                </div>

                @if($comp->stages->count() > 1)
                    <div style="margin-top:14px;">
                        <div style="font-weight:700;font-size:.82rem;margin-bottom:8px;"><i
                                class="fa-solid fa-layer-group text-red"></i> Tahapan Lomba</div>
                        <div class="step-list">
                            @foreach($comp->stages as $stage)
                                <div class="step-item">
                                    <div
                                        class="step-dot {{ $stage->stage_number < $part->current_stage ? 'done' : ($stage->stage_number === $part->current_stage ? 'active' : '') }}">
                                        @if($stage->stage_number < $part->current_stage)
                                            <i class="fa-solid fa-check"></i>
                                        @else
                                            {{ $stage->stage_number }}
                                        @endif
                                    </div>
                                    <div class="step-content">
                                        <div class="step-title">{{ $stage->stage_name }}</div>
                                        <div class="step-sub">
                                            {{ $stage->deadline ? 'Deadline: ' . $stage->deadline->format('d M Y') : '' }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Progress Steps --}}
            @if($steps->count() > 0)
                <div class="card">
                    <div style="font-weight:800;margin-bottom:14px;"><i class="fa-solid fa-list-check text-red"></i> Konfirmasi
                        Progres Siswa</div>
                    <div class="step-list">
                        @foreach($steps as $step)
                            <div class="step-item">
                                <div class="step-dot {{ $step->is_confirmed ? 'done' : '' }}">
                                    @if($step->is_confirmed)
                                        <i class="fa-solid fa-check"></i>
                                    @else
                                        {{ $step->step_order }}
                                    @endif
                                </div>
                                <div class="step-content" style="padding-top:4px;">
                                    <div class="step-title"
                                        style="{{ $step->is_confirmed ? 'text-decoration:line-through;opacity:.6;' : '' }}">
                                        {{ $step->step_name }}
                                    </div>
                                    @if($step->is_confirmed && $step->confirmed_at)
                                        <div class="step-sub">
                                            <i class="fa-solid fa-circle-check" style="color:#16a34a;"></i>
                                            Dikonfirmasi {{ $step->confirmed_at->format('d M Y H:i') }}
                                        </div>
                                    @endif
                                    @if($step->notes)
                                        <div class="step-sub" style="font-style:italic;">"{{ $step->notes }}"</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Kanan: Profil Siswa --}}
        <div>
            <div class="card" style="margin-bottom:14px;">
                <div style="text-align:center;margin-bottom:16px;">
                    <div
                        style="width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,var(--red),var(--yellow));display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.4rem;font-weight:800;margin:0 auto 10px;">
                        {{ strtoupper(substr($siswa->name, 0, 2)) }}
                    </div>
                    <div style="font-weight:800;font-size:.95rem;">{{ $siswa->name }}</div>
                    <div style="font-size:.78rem;color:var(--gray);">
                        {{ $siswa->studentProfile->kelas ?? '' }} — {{ $siswa->studentProfile->jurusan ?? '' }}
                    </div>
                    <div style="font-size:.75rem;color:var(--gray);margin-top:2px;">
                        Angkatan {{ $siswa->studentProfile->angkatan ?? '-' }}
                    </div>
                </div>

                <div style="font-size:.8rem;">
                    <div style="display:flex;gap:8px;align-items:center;margin-bottom:8px;">
                        <i class="fa-solid fa-id-badge text-gray" style="width:14px;"></i>
                        <span>NIS: {{ $siswa->studentProfile->nis ?? '-' }}</span>
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;margin-bottom:8px;">
                        <i class="fa-solid fa-envelope text-gray" style="width:14px;"></i>
                        <span style="word-break:break-all;">{{ $siswa->email }}</span>
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <i class="fa-brands fa-whatsapp" style="color:#25d366;width:14px;"></i>
                        <span>{{ $siswa->wa_number ?? 'Tidak ada' }}</span>
                    </div>
                </div>

                @if($siswa->wa_number)
                    <a href="https://wa.me/{{ $siswa->wa_number }}?text={{ urlencode('Halo ' . $siswa->name . ', saya ' . $mentorship->teacher->name . ' ingin membahas perkembangan lomba "' . $comp->title . '".') }}"
                        target="_blank" class="wa-btn" style="display:flex;justify-content:center;margin-top:14px;">
                        <i class="fa-brands fa-whatsapp"></i> Hubungi via WhatsApp
                    </a>
                @else
                    <div
                        style="margin-top:14px;font-size:.78rem;color:var(--gray);text-align:center;background:var(--gray-light);padding:8px;border-radius:8px;">
                        <i class="fa-solid fa-triangle-exclamation"></i> No. WA siswa belum diisi
                    </div>
                @endif
            </div>

            <a href="{{ route('teacher.mentorships') }}" class="btn btn-secondary btn-block">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endsection