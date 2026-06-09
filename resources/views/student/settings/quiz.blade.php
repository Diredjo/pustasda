@extends('layouts.app-student')
@section('title', 'Kuis Karakter')
@php $pageTitle = 'Kuis Karakter & Preferensi'; @endphp

@push('styles')
    <style>
    .quiz-wrap { max-width: 640px; margin: 0 auto; }
    .quiz-step  { display: none; }
    .quiz-step.active { display: block; animation: fadeIn 0.3s ease; }
    @keyframes fadeIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }

    .quiz-card {
        background: var(--white);
        border: 1.5px solid var(--gray-mid);
        border-radius: var(--radius);
        padding: 28px;
    }
    .quiz-header {
        margin-bottom: 24px;
    }
    .quiz-header .q-step-indicator {
        font-size: 0.75rem; color: var(--gray); margin-bottom: 6px;
        font-weight: 600; letter-spacing: 0.8px; text-transform: uppercase;
    }
    .quiz-header h2 { font-size: 1.15rem; font-weight: 800; }
    .quiz-header p  { font-size: 0.84rem; color: var(--gray); margin-top: 4px; }

    .quiz-progress-bar {
        height: 4px; background: var(--gray-light); border-radius: 2px;
        margin-bottom: 24px; overflow: hidden;
    }
    .quiz-progress-fill {
        height: 100%; background: linear-gradient(90deg, var(--red), var(--yellow));
        border-radius: 2px; transition: width 0.4s ease;
    }

    /* Pilihan multi */
    .choice-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-bottom: 16px;
    }
    .choice-item {
        padding: 12px 14px;
        border: 1.5px solid var(--gray-mid);
        border-radius: var(--radius-sm);
        cursor: pointer; transition: all var(--transition);
        display: flex; align-items: center; gap: 10px;
        font-size: 0.85rem;
    }
    .choice-item:hover   { border-color: var(--red); background: var(--red-light); }
    .choice-item.selected{ border-color: var(--red); background: var(--red-light); color: var(--red); font-weight: 600; }
    .choice-item i       { width: 20px; text-align: center; }

    /* Pilihan single */
    .single-grid { display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
    .single-item {
        padding: 12px 16px;
        border: 1.5px solid var(--gray-mid);
        border-radius: var(--radius-sm);
        cursor: pointer; transition: all var(--transition);
        font-size: 0.85rem; display: flex; align-items: center; gap: 10px;
    }
    .single-item:hover   { border-color: var(--red); background: var(--red-light); }
    .single-item.selected{ border-color: var(--red); background: var(--red-light); color: var(--red); font-weight: 600; }

    /* AI result */
    .bio-result {
        background: linear-gradient(135deg, #fff3f3, #fffbeb);
        border: 1.5px solid var(--yellow);
        border-radius: var(--radius);
        padding: 24px;
        text-align: center;
    }
    .bio-result .bio-icon {
        font-size: 2.5rem; color: var(--yellow); margin-bottom: 12px; display: block;
    }
    .bio-result .bio-text {
        font-size: 0.92rem; line-height: 1.8; color: var(--dark);
        font-style: italic;
    }
    .bio-result .bio-loading {
        display: flex; align-items: center; justify-content: center; gap: 12px;
        color: var(--gray); font-size: 0.88rem;
    }
    </style>
@endpush

@section('content')

    <div class="quiz-wrap">
        <div class="page-header">
            <h1><i class="fa-solid fa-brain text-red"></i> Kuis Karakter</h1>
            <p>Jawab beberapa pertanyaan, dan AI akan membuat profil dirimu otomatis!</p>
        </div>

        @if($profile->bio_ai)
            <div class="card" style="margin-bottom:20px; border-color:var(--yellow);">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <h4 style="font-weight:800;"><i class="fa-solid fa-id-card text-red"></i> Profil AI Kamu Saat Ini</h4>
                    <button class="btn btn-outline-red btn-sm" onclick="document.getElementById('quizWrap').style.display='block'">
                        <i class="fa-solid fa-rotate"></i> Isi Ulang Kuis
                    </button>
                </div>
                <div class="bio-result" style="text-align:left; padding:16px;">
                    <div class="bio-text">"{{ $profile->bio_ai }}"</div>
                </div>
            </div>
            <div id="quizWrap" style="display:none;">
        @else
            <div id="quizWrap">
        @endif

        {{-- Progress Bar --}}
        <div class="quiz-progress-bar">
            <div class="quiz-progress-fill" id="progressFill" style="width:20%;"></div>
        </div>

        <div class="quiz-card">
            {{-- STEP 1: Minat --}}
            <div class="quiz-step active" id="step1">
                <div class="quiz-header">
                    <div class="q-step-indicator"><i class="fa-solid fa-circle text-red" style="font-size:0.5rem;"></i> Langkah 1 dari 5</div>
                    <h2>Apa bidang yang paling kamu minati?</h2>
                    <p>Pilih minimal 1 bidang (bisa lebih dari satu)</p>
                </div>
                <div class="choice-grid">
                    <div class="choice-item" onclick="toggleChoice(this,'minat','Teknologi & Pemrograman')">
                        <i class="fa-solid fa-laptop-code"></i> Teknologi & Coding
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'minat','Desain & Multimedia')">
                        <i class="fa-solid fa-paint-brush"></i> Desain & Multimedia
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'minat','Sains & Matematika')">
                        <i class="fa-solid fa-flask"></i> Sains & Matematika
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'minat','Kewirausahaan')">
                        <i class="fa-solid fa-chart-line"></i> Kewirausahaan
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'minat','Robotika & IoT')">
                        <i class="fa-solid fa-robot"></i> Robotika & IoT
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'minat','Bahasa & Komunikasi')">
                        <i class="fa-solid fa-comments"></i> Bahasa & Komunikasi
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'minat','Networking & Keamanan')">
                        <i class="fa-solid fa-shield-halved"></i> Networking & Security
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'minat','Seni & Kreativitas')">
                        <i class="fa-solid fa-star"></i> Seni & Kreativitas
                    </div>
                </div>
                <button class="btn btn-primary btn-block" onclick="nextStep(1, 'minat')">
                    Lanjut <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            {{-- STEP 2: Keahlian --}}
            <div class="quiz-step" id="step2">
                <div class="quiz-header">
                    <div class="q-step-indicator"><i class="fa-solid fa-circle text-red" style="font-size:0.5rem;"></i> Langkah 2 dari 5</div>
                    <h2>Apa keahlian utamamu saat ini?</h2>
                    <p>Pilih keahlian yang sudah kamu kuasai</p>
                </div>
                <div class="choice-grid">
                    <div class="choice-item" onclick="toggleChoice(this,'keahlian','Pemrograman Web')">
                        <i class="fa-solid fa-code"></i> Pemrograman Web
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'keahlian','Mobile App')">
                        <i class="fa-solid fa-mobile-alt"></i> Mobile App
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'keahlian','Desain Grafis')">
                        <i class="fa-solid fa-pen-nib"></i> Desain Grafis
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'keahlian','Video Editing')">
                        <i class="fa-solid fa-video"></i> Video Editing
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'keahlian','Jaringan Komputer')">
                        <i class="fa-solid fa-network-wired"></i> Jaringan Komputer
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'keahlian','Presentasi & Public Speaking')">
                        <i class="fa-solid fa-microphone"></i> Presentasi
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'keahlian','Penelitian & Analisis')">
                        <i class="fa-solid fa-magnifying-glass-chart"></i> Riset & Analisis
                    </div>
                    <div class="choice-item" onclick="toggleChoice(this,'keahlian','Leadership')">
                        <i class="fa-solid fa-crown"></i> Leadership
                    </div>
                </div>
                <div style="display:flex; gap:8px;">
                    <button class="btn btn-secondary" onclick="prevStep(2)"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
                    <button class="btn btn-primary" style="flex:1;" onclick="nextStep(2, 'keahlian')">
                        Lanjut <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            {{-- STEP 3: Kepribadian --}}
            <div class="quiz-step" id="step3">
                <div class="quiz-header">
                    <div class="q-step-indicator"><i class="fa-solid fa-circle text-red" style="font-size:0.5rem;"></i> Langkah 3 dari 5</div>
                    <h2>Bagaimana kepribadianmu dalam tim?</h2>
                    <p>Pilih yang paling menggambarkan kamu</p>
                </div>
                <div class="single-grid">
                    <div class="single-item" onclick="selectSingle(this,'kepribadian','Pemimpin — suka mengatur dan memotivasi tim')">
                        <i class="fa-solid fa-crown text-yellow"></i> Pemimpin — suka mengatur dan memotivasi tim
                    </div>
                    <div class="single-item" onclick="selectSingle(this,'kepribadian','Eksekutor — fokus menyelesaikan tugas dengan baik')">
                        <i class="fa-solid fa-bolt text-red"></i> Eksekutor — fokus menyelesaikan tugas dengan baik
                    </div>
                    <div class="single-item" onclick="selectSingle(this,'kepribadian','Kreatif — penuh ide dan solusi inovatif')">
                        <i class="fa-solid fa-lightbulb" style="color:#f5a623;"></i> Kreatif — penuh ide dan solusi inovatif
                    </div>
                    <div class="single-item" onclick="selectSingle(this,'kepribadian','Analis — teliti, suka riset dan data')">
                        <i class="fa-solid fa-magnifying-glass" style="color:#17a2b8;"></i> Analis — teliti, suka riset dan data
                    </div>
                    <div class="single-item" onclick="selectSingle(this,'kepribadian','Komunikator — jago presentasi dan networking')">
                        <i class="fa-solid fa-comments" style="color:#28a745;"></i> Komunikator — jago presentasi dan networking
                    </div>
                </div>
                <div style="display:flex; gap:8px;">
                    <button class="btn btn-secondary" onclick="prevStep(3)"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
                    <button class="btn btn-primary" style="flex:1;" onclick="nextStep(3, 'kepribadian')">
                        Lanjut <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            {{-- STEP 4: Tujuan --}}
            <div class="quiz-step" id="step4">
                <div class="quiz-header">
                    <div class="q-step-indicator"><i class="fa-solid fa-circle text-red" style="font-size:0.5rem;"></i> Langkah 4 dari 5</div>
                    <h2>Apa tujuan terbesarmu setelah lulus SMK?</h2>
                    <p>Tuliskan rencana pengembangan dirimu</p>
                </div>
                <div class="form-group">
                    <textarea id="tujuanInput" class="form-control" rows="3"
                              placeholder="Contoh: Kuliah di jurusan Informatika dan membangun startup teknologi..."></textarea>
                </div>
                <div style="display:flex; gap:8px;">
                    <button class="btn btn-secondary" onclick="prevStep(4)"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
                    <button class="btn btn-primary" style="flex:1;" onclick="nextStep(4, 'tujuan')">
                        Lanjut <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            {{-- STEP 5: Pengalaman --}}
            <div class="quiz-step" id="step5">
                <div class="quiz-header">
                    <div class="q-step-indicator"><i class="fa-solid fa-circle text-red" style="font-size:0.5rem;"></i> Langkah 5 dari 5</div>
                    <h2>Bagaimana pengalaman lombamu selama ini?</h2>
                </div>
                <div class="single-grid">
                    <div class="single-item" onclick="selectSingle(this,'pengalaman','Belum pernah ikut lomba sama sekali')">
                        <i class="fa-solid fa-seedling" style="color:#28a745;"></i> Belum pernah ikut lomba
                    </div>
                    <div class="single-item" onclick="selectSingle(this,'pengalaman','Sudah pernah ikut 1-2 lomba sebelumnya')">
                        <i class="fa-solid fa-star-half-stroke text-yellow"></i> Sudah 1-2 kali ikut lomba
                    </div>
                    <div class="single-item" onclick="selectSingle(this,'pengalaman','Aktif ikut lomba dan beberapa kali meraih juara')">
                        <i class="fa-solid fa-medal text-red"></i> Aktif dan pernah juara
                    </div>
                    <div class="single-item" onclick="selectSingle(this,'pengalaman','Sangat berpengalaman, sering mewakili sekolah di lomba bergengsi')">
                        <i class="fa-solid fa-trophy" style="color:#f5a623;"></i> Sangat berpengalaman
                    </div>
                </div>
                <div style="display:flex; gap:8px;">
                    <button class="btn btn-secondary" onclick="prevStep(5)"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
                    <button class="btn btn-primary" style="flex:1;" id="btnSubmitQuiz" onclick="submitQuiz()">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> Buat Profil AI
                    </button>
                </div>
            </div>

            {{-- STEP 6: Hasil AI --}}
            <div class="quiz-step" id="step6">
                <div class="quiz-header">
                    <h2><i class="fa-solid fa-wand-magic-sparkles text-red"></i> Profil AI Kamu</h2>
                    <p>AI telah membuat deskripsi dirimu berdasarkan jawabanmu</p>
                </div>
                <div class="bio-result" id="bioResult">
                    <div class="bio-loading" id="bioLoading">
                        <div class="spinner"></div>
                        <span>AI sedang menganalisis karaktermu...</span>
                    </div>
                    <div id="bioContent" style="display:none;">
                        <i class="fa-solid fa-id-badge bio-icon"></i>
                        <div class="bio-text" id="bioText"></div>
                    </div>
                </div>
                <div style="margin-top:16px; display:none;" id="bioActions">
                    <a href="{{ route('student.dashboard') }}" class="btn btn-primary btn-block">
                        <i class="fa-solid fa-house"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
    const quizData = { minat: [], keahlian: [], kepribadian: '', tujuan: '', pengalaman: '' };
    let currentStep = 1;
    const totalSteps = 5;

    function updateProgress(step) {
        document.getElementById('progressFill').style.width = ((step / totalSteps) * 100) + '%';
    }

    function toggleChoice(el, field, value) {
        el.classList.toggle('selected');
        if (el.classList.contains('selected')) {
            if (!quizData[field].includes(value)) quizData[field].push(value);
        } else {
            quizData[field] = quizData[field].filter(v => v !== value);
        }
    }

    function selectSingle(el, field, value) {
        document.querySelectorAll(`#step${currentStep} .single-item`).forEach(i => i.classList.remove('selected'));
        el.classList.add('selected');
        quizData[field] = value;
    }

    function nextStep(from, field) {
        // Validasi
        if (field === 'minat' && quizData.minat.length === 0) {
            showToast('Perhatian', 'Pilih minimal 1 minat!', 'warning');
            return;
        }
        if (field === 'keahlian' && quizData.keahlian.length === 0) {
            showToast('Perhatian', 'Pilih minimal 1 keahlian!', 'warning');
            return;
        }
        if (field === 'kepribadian' && !quizData.kepribadian) {
            showToast('Perhatian', 'Pilih kepribadianmu!', 'warning');
            return;
        }
        if (field === 'tujuan') {
            const val = document.getElementById('tujuanInput').value.trim();
            if (!val) { showToast('Perhatian', 'Isi tujuanmu dulu!', 'warning'); return; }
            quizData.tujuan = val;
        }

        document.getElementById('step' + from).classList.remove('active');
        const next = from + 1;
        document.getElementById('step' + next).classList.add('active');
        currentStep = next;
        updateProgress(next);
    }

    function prevStep(from) {
        document.getElementById('step' + from).classList.remove('active');
        document.getElementById('step' + (from - 1)).classList.add('active');
        currentStep = from - 1;
        updateProgress(from - 1);
    }

    function submitQuiz() {
        if (!quizData.pengalaman) {
            showToast('Perhatian', 'Pilih pengalaman lombamu!', 'warning');
            return;
        }

        document.getElementById('step5').classList.remove('active');
        document.getElementById('step6').classList.add('active');
        updateProgress(6);

        fetch('{{ route("student.settings.quiz.process") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(quizData),
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('bioLoading').style.display = 'none';
            document.getElementById('bioContent').style.display = 'block';
            document.getElementById('bioText').textContent = data.bio;
            document.getElementById('bioActions').style.display = 'block';
            showToast('Profil Dibuat!', 'AI berhasil membuat profil untukmu.', 'success');
        });
    }
    </script>
@endpush