<?php

use Illuminate\Support\Facades\Route;

// Auth Controller
use App\Http\Controllers\Auth\LoginController;

// Student Controllers
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\ExploreController;
use App\Http\Controllers\Student\ParticipationController;
use App\Http\Controllers\Student\TeamController;
use App\Http\Controllers\Student\SettingsController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Student\RecapitulationController;
use App\Http\Controllers\Student\LeaderboardController;

// Teacher Controllers
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Teacher\MentorshipController as TeacherMentorship;
use App\Http\Controllers\Teacher\NotificationController as TeacherNotif;

// Admin & Developer Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\CompetitionController as AdminCompetition;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\FieldController as AdminField;
use App\Http\Controllers\Admin\NotificationController as AdminNotif;
use App\Http\Controllers\Developer\DashboardController as DeveloperDashboard;

// =========================================================================
// 1. GUEST & AUTHENTICATION ROUTES
// =========================================================================
Route::get('/', fn() => redirect()->route('login'));

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// =========================================================================
// 2. STUDENT ROUTES (Akses: Siswa SMK Telkom Sidoarjo / Skomda)
// =========================================================================
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');

    // Explorer (Kompetisi & Prestasi)
    Route::controller(ExploreController::class)->prefix('explore')->name('explore.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{competition}/detail', 'show')->name('show');
        Route::post('/{competition}/save', 'save')->name('save');
    });

    // Participations (Alur Mengikuti Lomba)
    Route::controller(ParticipationController::class)->prefix('participations')->name('participations.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{participation}', 'show')->name('show');
        Route::post('/join', 'join')->name('join');
        Route::post('/{participation}/step', 'confirmStep')->name('step');
        Route::post('/{participation}/result', 'submitResult')->name('result');
        Route::post('/{participation}/mentor', 'requestMentor')->name('mentor');
    });

    // Teams (Manajemen Kelompok Lomba)
    Route::controller(TeamController::class)->prefix('teams')->name('teams.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/join', 'joinForm')->name('join');
        Route::post('/join', 'joinSubmit')->name('join.submit');
        Route::get('/{team}', 'show')->name('show');
        Route::post('/{team}/apply', 'apply')->name('apply');
        Route::post('/{team}/respond/{member}', 'respond')->name('respond');
    });

    // Settings & Kuisioner Keahlian
    Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function () {
        Route::get('/', fn() => redirect()->route('student.settings.profile'));
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/profile', 'updateProfile')->name('profile.update');
        Route::get('/quiz', 'quiz')->name('quiz');
        Route::post('/quiz', 'processQuiz')->name('quiz.process');
        Route::get('/privacy', 'privacy')->name('privacy');
        Route::post('/privacy', 'updatePrivacy')->name('privacy.update');
        Route::get('/notification', 'notification')->name('notification');
        Route::post('/notification', 'updateNotification')->name('notification.update');
    });

    // Rekapitulasi Nilai & Peringkat / Leaderboard
    Route::get('/recapitulation', [RecapitulationController::class, 'index'])->name('recapitulation');
    Route::post('/recapitulation/summarize', [RecapitulationController::class, 'summarize'])->name('recapitulation.summarize');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

    // Pusat Notifikasi Student
    Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')->group(function () {
        Route::post('/{id}/read', 'read')->name('read');
        Route::post('/read-all', 'readAll')->name('readAll');
    });
});

// =========================================================================
// 3. TEACHER ROUTES (Akses: Pembimbing / Guru Produktif)
// =========================================================================
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {

    // Dashboard Utama Guru
    Route::get('/dashboard', [TeacherDashboard::class, 'index'])->name('dashboard');

    // Manajemen Bimbingan Lomba Siswa
    Route::controller(TeacherMentorship::class)->prefix('mentorships')->name('mentorships.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{mentorship}', 'show')->name('show');
        Route::post('/{mentorship}/respond', 'respond')->name('respond');
    });

    // Pengaturan Akun Guru
    Route::get('/profile', fn() => view('teacher.profile'))->name('profile');
    Route::get('/settings', fn() => redirect()->route('teacher.profile'))->name('settings');

    // Pusat Notifikasi Guru
    Route::controller(TeacherNotif::class)->prefix('notifications')->name('notifications.')->group(function () {
        Route::post('/{id}/read', 'read')->name('read');
        Route::post('/read-all', 'readAll')->name('readAll');
    });
});

// =========================================================================
// 4. ADMIN & DEVELOPER ROUTES (Manajemen Backend Pustasda)
// =========================================================================
Route::middleware(['auth', 'role:admin,developer'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin Utama
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // --- SUB-KATEGORI: KELOLA DATA USERS & MAHASISWA ---
    Route::controller(AdminUser::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
        Route::post('/{user}/toggle-active', 'toggleActive')->name('toggle');

        // Fitur Tambah Masal / Bulk Create (Burst)
        Route::get('/burst', 'burstCreate')->name('burst');
        Route::post('/burst/preview', 'burstPreview')->name('bulk-preview');
        Route::post('/burst/store', 'burstStore')->name('bulk-store');
    });

    // --- SUB-KATEGORI: KELOLA EVENT KOMPETISI / LKS ---
    Route::controller(AdminCompetition::class)->prefix('competitions')->name('competitions.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{competition}/edit', 'edit')->name('edit');
        Route::put('/{competition}', 'update')->name('update');
        Route::delete('/{competition}', 'destroy')->name('destroy');
        Route::post('/{competition}/toggle', 'toggleActive')->name('toggle');
    });

    // --- SUB-KATEGORI: KELOLA KATEGORI LOMBA ---
    Route::controller(AdminCategory::class)->prefix('categories')->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{category}', 'update')->name('update');
        Route::delete('/{category}', 'destroy')->name('destroy');
    });

    // --- SUB-KATEGORI: Kelola Bidang / Jurusan (RPL, TKJ, DKV, dll.) ---
    Route::controller(AdminField::class)->prefix('fields')->name('fields.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{field}', 'update')->name('update');
        Route::delete('/{field}', 'destroy')->name('destroy');
    });

    // Monitoring Leaderboard Berprestasi Sekolah
    Route::get('/leaderboard', fn() => view('admin.leaderboard'))->name('leaderboard');

    // Pusat Notifikasi Admin
    Route::controller(AdminNotif::class)->prefix('notifications')->name('notifications.')->group(function () {
        Route::post('/{id}/read', 'read')->name('read');
        Route::post('/read-all', 'readAll')->name('readAll');
    });
});

// =========================================================================
// 5. DEVELOPER SPECIFIC ROUTES
// =========================================================================
Route::middleware(['auth', 'role:developer'])->prefix('developer')->name('developer.')->group(function () {
    Route::get('/dashboard', [DeveloperDashboard::class, 'index'])->name('dashboard');
});