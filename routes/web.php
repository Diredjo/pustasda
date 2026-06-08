<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Developer\DashboardController as DeveloperDashboard;


// ===================== AUTH =====================
// Bikin URL /login bisa diakses langsung (GET)
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Kalau user akses URL utama '/', oper aja langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// ===================== STUDENT =====================
// Tambahkan di dalam group middleware student:
use App\Http\Controllers\Student\ExploreController;
use App\Http\Controllers\Student\NotificationController;

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');

    // Explorer
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::get('/explore/{competition}', [ExploreController::class, 'show'])->name('explore.show');
    Route::post('/explore/{competition}/save', [ExploreController::class, 'save'])->name('explore.save');

    // Notifications
    Route::post('/notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');

    // Placeholder routes (untuk fase 4-5)
    Route::get('/participations', fn() => view('student.participations'))->name('participations');
    Route::get('/participations/{id}', fn() => back())->name('participations.show');
    Route::post('/participations/join', fn() => back())->name('participations.join');
    Route::get('/recapitulation', fn() => view('student.recapitulation'))->name('recapitulation');
    Route::get('/leaderboard', fn() => view('student.leaderboard'))->name('leaderboard');
    Route::get('/settings/profile', fn() => view('student.settings.profile'))->name('settings.profile');
    Route::get('/settings/quiz', fn() => view('student.settings.quiz'))->name('settings.quiz');
    Route::get('/settings/privacy', fn() => view('student.settings.privacy'))->name('settings.privacy');
    Route::get('/settings/notification', fn() => view('student.settings.notification'))->name('settings.notification');
    Route::get('/profile', fn() => view('student.settings.profile'))->name('profile');
    Route::get('/settings', fn() => redirect()->route('student.settings.profile'))->name('settings');
    Route::get('/teams/create', fn() => back())->name('teams.create');
    Route::get('/teams', fn() => back())->name('teams.index');
    Route::get('/teams/join', fn() => back())->name('teams.join');
});

// ===================== TEACHER =====================
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboard::class, 'index'])->name('dashboard');
});

// ===================== ADMIN =====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
});

// ===================== DEVELOPER =====================
Route::middleware(['auth', 'role:developer'])->prefix('developer')->name('developer.')->group(function () {
    Route::get('/dashboard', [DeveloperDashboard::class, 'index'])->name('dashboard');
});