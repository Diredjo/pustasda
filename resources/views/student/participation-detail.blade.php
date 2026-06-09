@extends('layouts.app-student')
@section('title', 'Detail Lomba')
@php $pageTitle = 'Detail Lomba Saya'; @endphp

@push('styles')
    <style>
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 20px;
        }

        .detail-main {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .detail-side {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .section-card {
            background: var(--white);
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .section-card-header {
            padding: 14px 18px;
            border-bottom: 1px solid var(--gray-light);
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg);
        }

        .section-card-header h4 {
            font-size: 0.9rem;
            font-weight: 700;
        }

        .section-card-body {
            padding: 18px;
        }

        /* Big step confirm */
        .confirm-step-card {
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius-sm);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 10px;
            transition: all var(--transition);
        }

        .confirm-step-card.done {
            background: #f0fff4;
            border-color: #86efac;
        }

        .confirm-step-card.active {
            background: #fffbeb;
            border-color: #fcd34d;
        }

        .csc-dot {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .csc-dot.done {
            background: #16a34a;
            color: #fff;
        }

        .csc-dot.active {
            background: var(--yellow);
            color: #fff;
        }

        .csc-dot.pending {
            background: var(--gray-light);
            color: var(--gray);
            border: 2px solid var(--gray-mid);
        }

        .csc-info .csc-title {
            font-weight: 700;
            font-size: 0.88rem;
        }

        .csc-info .csc-time {
            font-size: 0.74rem;
            color: var(--gray);
        }

        .csc-action {
            margin-left: auto;
        }

        /* Teacher picker */
        .teacher-pick {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border: 1.5px solid var(--gray-mid);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all var(--transition);
            margin-bottom: 8px;
        }

        .teacher-pick:hover {
            border-color: var(--red);
            background: var(--red-light);
        }

        .teacher-pick.selected {
            border-color: var(--red);
            background: var(--red-light);
        }

        .teacher-pick .tp-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--red), var(--yellow));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .teacher-pick .tp-name {
            font-weight: 700;
            font-size: 0.85rem;
        }

        .teacher-pick .tp-bidang {
            font-size: 0.75rem;
            color: var(--gray);
        }

        @media(max-width:900px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
        <a href="{{ route('student.participations') }}" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h1 style="font-size:1.2rem; font-weight:800;">{{ $participation->competition->title }}</h1>
            <div style="font-size:0.8rem; color:var(--gray);">
                <i class="fa-solid fa-building"></i> {{ $participation->competition->organizer }}
            </div>
        </div>
    </div>

    <div class="detail-grid">
        {{-- KIRI --}}
        <div class="detail-main">

            {{-- Step Konfirmasi --}}
            <div class="section-card">
                <div class="section-card-header">
                    <i class="fa-solid fa-shoe-prints text-red"></i>
                    <h4>Konfirmasi Progres Langkah</h4>
                </div>
                <div class="section-card-body">
                    @foreach($participation->steps->sortBy('step_order') as $step)
                        @php
                            $statusMap = ['registered' => 1, 'in_progress' => 2, 'submitted' => 3, 'not_submitted' => 3, 'completed' => 4];
                            $curStep = $statusMap[$participation->status] ?? 1;
                            $isDone = $step->is_confirmed;
                            $isActive = !$isDone && $step->step_order === $curStep;
                        @endphp
                        <div class="confirm-step-card {{ $isDone ? 'done' : ($isActive ? 'active' : '') }}">
                            <div class="csc-dot {{ $isDone ? 'done' : ($isActive ? 'active' : 'pending') }}">
                                @if($isDone)
                                    <i class="fa-solid fa-check"></i>
                                @elseif($isActive)
                                    <i class="fa-solid fa-hourglass-half"></i>
                                @else
                                    {{ $step->step_order }}
                                @endif
                            </div>
                            <div class="csc-info">
                                <div class="csc-title">{{ $step->step_name }}</div>
                                @if($isDone)
                                    <div class="csc-time">
                                        <i class="fa-solid fa-check-circle" style="color:#16a34a;"></i>
                                        Dikonfirmasi {{ $step->confirmed_at->format('d M Y, H:i') }}
                                    </div>
                                @elseif($isActive)
                                    <div class="csc-time">Klik tombol konfirmasi untuk melanjutkan</div>
                                @else
                                    <div class="csc-time">Menunggu langkah sebelumnya</div>
                                @endif
                                @if($step->notes)
                                    <div style="font-size:0.75rem; color:var(--gray); margin-top:3px;">
                                        Catatan: {{ $step->notes }}
                                    </div>
                                @endif
                            </div>
                            <div class="csc-action">
                                @if($isDone)
                                    <span class="btn btn-sm" style="background:#d4edda;color:#155724; cursor:default;">
                                        <i class="fa-solid fa-check"></i> Selesai
                                    </span>
                                @elseif($isActive)
                                    <button class="btn btn-primary btn-sm"
                                        onclick="confirmStep({{ $participation->id }}, {{ $step->step_order }})">
                                        <i class="fa-solid fa-circle-check"></i> Konfirmasi
                                    </button>
                                @else
                                    <span class="btn btn-sm btn-secondary" style="cursor:not-allowed; opacity:0.5;">
                                        <i class="fa-solid fa-lock"></i> Terkunci
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{-- Tombol Tidak Submit --}}
                    @if($participation->status === 'in_progress')
                        <button class="btn btn-secondary btn-sm" style="margin-top:8px;"
                            onclick="if(confirm('Tandai sebagai tidak submit?')) markNotSubmit({{ $participation->id }})">
                            <i class="fa-solid fa-xmark"></i> Tidak Submit
                        </button>
                    @endif
                </div>
            </div>

            {{-- Konfirmasi Hasil (muncul setelah deadline) --}}
            @if($participation->competition->deadline->isPast() || $participation->status === 'submitted' || $participation->status === 'completed')
                <div class="section-card">
                    <div class="section-card-header">
                        <i class="fa-solid fa-medal text-yellow"></i>
                        <h4>Konfirmasi Hasil Lomba</h4>
                    </div>
                    <div class="section-card-body">
                        @if($participation->result !== 'belum_diisi')
                            <div style="text-align:center; padding:16px 0;">
                                <i class="fa-solid fa-trophy"
                                    style="font-size:2.5rem; color:var(--yellow); margin-bottom:10px; display:block;"></i>
                                <div style="font-size:1.1rem; font-weight:800;">
                                    @php
                                        $rl = ['juara_1' => 'Juara 1', 'juara_2' => 'Juara 2', 'juara_3' => 'Juara 3', 'juara_harapan' => 'Juara Harapan', 'favorit' => 'Favorit', 'terpilih' => 'Terpilih', 'lolos_tahap' => 'Lolos Tahap', 'tidak_lolos' => 'Tidak Lolos'];
                                    @endphp
                                    {{ $rl[$participation->result] ?? $participation->result }}
                                </div>
                                @if($participation->notes)
                                    <div style="font-size:0.82rem; color:var(--gray); margin-top:8px;">{{ $participation->notes }}</div>
                                @endif
                                <button class="btn btn-secondary btn-sm" style="margin-top:12px;"
                                    onclick="openResultModal({{ $participation->id }})">
                                    <i class="fa-solid fa-pen"></i> Ubah Hasil
                                </button>
                            </div>
                        @else
                            <p style="font-size:0.85rem; color:var(--gray); margin-bottom:16px;">
                                Lomba sudah selesai. Isi hasil akhirmu!
                            </p>
                            <button class="btn btn-primary btn-block" onclick="openResultModal({{ $participation->id }})">
                                <i class="fa-solid fa-medal"></i> Isi Hasil Lomba
                            </button>
                        @endif

                        {{-- Lomba bertahap --}}
                        @if($participation->competition->total_stages > 1)
                            <div class="divider"></div>
                            <div style="font-size:0.82rem; font-weight:700; margin-bottom:10px;">
                                <i class="fa-solid fa-layer-group text-red"></i> Tahap yang Diikuti
                            </div>
                            @foreach($participation->competition->stages as $stage)
                                <div
                                    style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:1px solid var(--gray-light);">
                                    <div
                                        style="width:24px; height:24px; border-radius:50%; background:{{ $participation->current_stage >= $stage->stage_number ? 'var(--red)' : 'var(--gray-light)' }}; color:{{ $participation->current_stage >= $stage->stage_number ? '#fff' : 'var(--gray)' }}; display:flex; align-items:center; justify-content:center; font-size:0.72rem; font-weight:700;">
                                        {{ $stage->stage_number }}
                                    </div>
                                    <div>
                                        <div style="font-weight:600; font-size:0.82rem;">{{ $stage->stage_name }}</div>
                                        <div style="font-size:0.72rem; color:var(--gray);">{{ $stage->deadline?->format('d M Y') }}
                                        </div>
                                    </div>
                                    @if($participation->current_stage >= $stage->stage_number)
                                        <i class="fa-solid fa-check-circle" style="color:#16a34a; margin-left:auto;"></i>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif

        </div>

        {{-- KANAN --}}
        <div class="detail-side">

            {{-- Info Lomba --}}
            <div class="section-card">
                <div class="section-card-header">
                    <i class="fa-solid fa-circle-info text-red"></i>
                    <h4>Info Lomba</h4>
                </div>
                <div class="section-card-body" style="padding:14px 18px;">
                    <div class="er-info-row">
                        <i class="fa-solid fa-calendar-xmark"></i>
                        <span class="er-info-label">Deadline</span>
                        <span class="er-info-value">{{ $participation->competition->deadline->format('d M Y') }}</span>
                    </div>
                    <div class="er-info-row">
                        <i class="fa-solid fa-flag"></i>
                        <span class="er-info-label">Level</span>
                        <span class="er-info-value">{{ ucfirst($participation->competition->level) }}</span>
                    </div>
                    @if($participation->competition->link_registration)
                        <div class="er-info-row">
                            <i class="fa-solid fa-link"></i>
                            <span class="er-info-label">Link</span>
                            <a href="{{ $participation->competition->link_registration }}" target="_blank"
                                class="er-info-value text-red" style="word-break:break-all; font-size:0.78rem;">
                                Buka <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:0.65rem;"></i>
                            </a>
                        </div>
                    @endif
                    @if($participation->competition->deadline->isFuture())
                        <div
                            style="margin-top:10px; padding:10px; background:var(--red-light); border-radius:var(--radius-sm);">
                            <div style="font-size:0.7rem; color:var(--gray); margin-bottom:4px;">Sisa Waktu:</div>
                            <div id="cd-detail-{{ $participation->id }}"></div>
                            <script>
                                document.addEventListener('DOMContentLoaded', () =>
                                    startCountdown('{{ $participation->competition->deadline->toIso8601String() }}', 'cd-detail-{{ $participation->id }}')
                                );
                            </script>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Tim (jika ada) --}}
            @if($participation->team)
                <div class="section-card">
                    <div class="section-card-header">
                        <i class="fa-solid fa-users text-red"></i>
                        <h4>Tim: {{ $participation->team->team_name }}</h4>
                    </div>
                    <div class="section-card-body" style="padding:10px 14px;">
                        @foreach($participation->team->members->where('status', 'accepted') as $member)<div style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:1px solid var(--gray-light);">
                                <div style="width:32px; height:32px; border-radius:8px; background:linear-gradient(135deg,var(--red),var(--yellow)); display:flex; align-items:center; justify-content:center; color:#fff; font-size:0.72rem; font-weight:700;">
                                    {{ strtoupper(substr($member->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-size:0.82rem; font-weight:600;">{{ $member->user->name }}</div>
                                    @if($participation->team->leader_id === $member->user_id)
                                        <div style="font-size:0.7rem; color:var(--red);">Ketua</div>
                                    @endif
                                </div>
                                @if($member->user->wa_number)
                                    <a href="https://wa.me/{{ $member->user->wa_number }}" target="_blank"
                                       style="margin-left:auto;" class="btn btn-sm" style="padding:4px 8px; background:#25d366; color:#fff; border-radius:6px; font-size:0.7rem;">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Pengajuan Guru --}}
            <div class="section-card">
                <div class="section-card-header">
                    <i class="fa-solid fa-chalkboard-teacher text-red"></i>
                    <h4>Guru Pembimbing</h4>
                </div>
                <div class="section-card-body">
                    @if($participation->mentorship)
                        <div style="display:flex; align-items:center; gap:12px; padding:10px; background:var(--gray-light); border-radius:var(--radius-sm);">
                            <div style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg,var(--red),var(--yellow)); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:0.8rem;">
                                {{ strtoupper(substr($participation->mentorship->teacher->name, 0, 2)) }}
                            </div>
                            <div>
                                <div style="font-weight:700; font-size:0.85rem;">{{ $participation->mentorship->teacher->name }}</div>
                                <div style="font-size:0.72rem; color:var(--gray);">
                                    {{ $participation->mentorship->teacher->teacherProfile->bidang_keahlian ?? '' }}
                                </div>
                            </div>
                            <div style="margin-left:auto;">
                                @if($participation->mentorship->status === 'accepted')
                                    <span style="font-size:0.72rem; background:#d4edda; color:#155724; padding:3px 8px; border-radius:10px;">Aktif</span>
                                    @if($participation->mentorship->teacher->wa_number)
                                        <a href="https://wa.me/{{ $participation->mentorship->teacher->wa_number }}" target="_blank"
                                           class="btn btn-sm" style="background:#25d366; color:#fff; margin-top:4px; display:flex; align-items:center; gap:4px; font-size:0.75rem;">
                                            <i class="fa-brands fa-whatsapp"></i> Chat WA
                                        </a>
                                    @endif
                                @elseif($participation->mentorship->status === 'pending')
                                    <span style="font-size:0.72rem; background:#fff3cd; color:#856404; padding:3px 8px; border-radius:10px;">Menunggu</span>
                                @else
                                    <span style="font-size:0.72rem; background:#f8d7da; color:#721c24; padding:3px 8px; border-radius:10px;">Ditolak</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <p style="font-size:0.82rem; color:var(--gray); margin-bottom:14px;">
                            Belum ada guru pembimbing. Ajukan guru untuk membantu proses lombamu.
                        </p>
                        <button class="btn btn-outline-red btn-block" onclick="openMentorModal()">
                            <i class="fa-solid fa-user-plus"></i> Ajukan Guru Pembimbing
                        </button>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Modal Pilih Guru --}}
    <div class="modal-overlay" id="mentorModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3><i class="fa-solid fa-chalkboard-teacher text-red"></i> Pilih Guru Pembimbing</h3>
                <button class="modal-close" onclick="closeMentorModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <p style="font-size:0.82rem; color:var(--gray); margin-bottom:16px;">
                Pilih guru yang akan membimbingmu. Guru akan mendapat notifikasi dan kamu bisa koordinasi via WhatsApp.
            </p>
            <div id="teacherList">
                @foreach($teachers as $teacher)
                    <div class="teacher-pick" id="tp-{{ $teacher->id }}" onclick="selectTeacher({{ $teacher->id }}, this)">
                        <div class="tp-avatar">{{ strtoupper(substr($teacher->name, 0, 2)) }}</div>
                        <div>
                            <div class="tp-name">{{ $teacher->name }}</div>
                            <div class="tp-bidang">{{ $teacher->teacherProfile->bidang_keahlian ?? 'Guru' }}</div>
                        </div>
                        <i class="fa-regular fa-circle" id="tpcheck-{{ $teacher->id }}" style="margin-left:auto; color:var(--gray);"></i>
                    </div>
                @endforeach
            </div>
            <div style="display:flex; gap:8px; margin-top:16px;">
                <button class="btn btn-primary" id="btnSubmitMentor" onclick="submitMentor({{ $participation->id }})" disabled>
                    <i class="fa-solid fa-paper-plane"></i> Kirim Permintaan
                </button>
                <button class="btn btn-secondary" onclick="closeMentorModal()">Batal</button>
            </div>
        </div>
    </div>

    {{-- Modal Hasil Lomba --}}
    <div class="modal-overlay" id="resultModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3><i class="fa-solid fa-medal text-yellow"></i> Isi Hasil Lomba</h3>
                <button class="modal-close" onclick="document.getElementById('resultModal').classList.remove('open')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('student.participations.result', $participation->id) }}">
                @csrf
                <div class="form-group">
                    <label>Hasil yang Dicapai</label>
                    <select name="result" class="form-control" required>
                        <option value="">-- Pilih hasil --</option>
                        <option value="juara_1">Juara 1</option>
                        <option value="juara_2">Juara 2</option>
                        <option value="juara_3">Juara 3</option>
                        <option value="juara_harapan">Juara Harapan</option>
                        <option value="favorit">Favorit</option>
                        <option value="terpilih">Terpilih</option>
                        <option value="lolos_tahap">Lolos ke Tahap Selanjutnya</option>
                        <option value="tidak_lolos">Tidak Lolos</option>
                    </select>
                </div>
                @if($participation->competition->total_stages > 1)
                    <div class="form-group">
                        <label>Lolos Sampai Tahap ke-</label>
                        <select name="current_stage" class="form-control">
                            @for($s = 1; $s <= $participation->competition->total_stages; $s++)
                                <option value="{{ $s }}" {{ $participation->current_stage === $s ? 'selected' : '' }}>
                                    Tahap {{ $s }}
                                </option>
                            @endfor
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label>Catatan (opsional)</label>
                    <textarea name="notes" class="form-control" rows="2"
                              placeholder="Ceritakan pengalamanmu...">{{ $participation->notes }}</textarea>
                </div>
                <div style="display:flex; gap:8px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Simpan Hasil
                    </button>
                    <button type="button" class="btn btn-secondary"
                            onclick="document.getElementById('resultModal').classList.remove('open')">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
    let selectedTeacherId = null;

    function openMentorModal() {
        document.getElementById('mentorModal').classList.add('open');
    }
    function closeMentorModal() {
        document.getElementById('mentorModal').classList.remove('open');
    }
    function selectTeacher(id, el) {
        document.querySelectorAll('.teacher-pick').forEach(t => {
            t.classList.remove('selected');
            t.querySelector('i').className = 'fa-regular fa-circle';
            t.querySelector('i').style.marginLeft = 'auto';
            t.querySelector('i').style.color = 'var(--gray)';
        });
        el.classList.add('selected');
        el.querySelector('i').className = 'fa-solid fa-check-circle';
        el.querySelector('i').style.color = 'var(--red)';
        selectedTeacherId = id;
        document.getElementById('btnSubmitMentor').disabled = false;
    }
    function submitMentor(participationId) {
        if (!selectedTeacherId) return;
        fetch(`/student/participations/${participationId}/mentor`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ teacher_id: selectedTeacherId })
        })
        .then(r => r.json())
        .then(data => {
            if (data.ok) {
                closeMentorModal();
                showToast('Berhasil', data.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showToast('Gagal', data.error || 'Terjadi kesalahan');
            }
        });
    }

    function confirmStep(participationId, stepOrder) {
        const notes = prompt('Tambahkan catatan (opsional):') ?? '';
        fetch(`/student/participations/${participationId}/step`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ step_order: stepOrder, notes: notes })
        })
        .then(r => r.json())
        .then(data => {
            if (data.ok) {
                showToast('Berhasil', data.message, 'success');
                setTimeout(() => location.reload(), 1000);
            }
        });
    }

    function markNotSubmit(id) {
        fetch(`/student/participations/${id}/step`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
            body: JSON.stringify({ step_order: 99 })
        }).then(() => location.reload());
    }

    function openResultModal(id) {
        document.getElementById('resultModal').classList.add('open');
    }
    </script>
@endpush