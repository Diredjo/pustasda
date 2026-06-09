<?php

use Illuminate\Support\Facades\Route;

// Import Controllers
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

// ==================================================
// AUTHENTICATION
// ==================================================
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', fn() => redirect()->route('login'));

// ==================================================
// STUDENT ROUTES
// ==================================================
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');

    // Explorer
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::get('/explore/{competition}/detail', [ExploreController::class, 'show'])->name('explore.show');
    Route::post('/explore/{competition}/save', [ExploreController::class, 'save'])->name('explore.save');

    // Participations
    Route::controller(ParticipationController::class)->group(function () {
        Route::get('/participations', 'index')->name('participations');
        Route::get('/participations/{participation}', 'show')->name('participations.show');
        Route::post('/participations/join', 'join')->name('participations.join');
        Route::post('/participations/{participation}/step', 'confirmStep')->name('participations.step');
        Route::post('/participations/{participation}/result', 'submitResult')->name('participations.result');
        Route::post('/participations/{participation}/mentor', 'requestMentor')->name('participations.mentor');
    });

    // Teams
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

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', fn() => redirect()->route('student.settings.profile'));
        Route::get('/profile', [SettingsController::class, 'profile'])->name('profile');
        Route::post('/profile', [SettingsController::class, 'updateProfile'])->name('profile.update');
        Route::get('/quiz', [SettingsController::class, 'quiz'])->name('quiz');
        Route::post('/quiz', [SettingsController::class, 'processQuiz'])->name('quiz.process');
        Route::get('/privacy', [SettingsController::class, 'privacy'])->name('privacy');
        Route::post('/privacy', [SettingsController::class, 'updatePrivacy'])->name('privacy.update');
        Route::get('/notification', [SettingsController::class, 'notification'])->name('notification');
        Route::post('/notification', [SettingsController::class, 'updateNotification'])->name('notification.update');
    });

    // Recapitulation & Leaderboard
    Route::get('/recapitulation', [RecapitulationController::class, 'index'])->name('recapitulation');
    Route::post('/recapitulation/summarize', [RecapitulationController::class, 'summarize'])->name('recapitulation.summarize');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

    // Notifications
    Route::post('/notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');
});

// ==================================================
// TEACHER ROUTES
// ==================================================
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboard::class, 'index'])->name('dashboard');

    // Bimbingan
    Route::get('/mentorships', [TeacherMentorship::class, 'index'])->name('mentorships');
    Route::get('/mentorships/{mentorship}', [TeacherMentorship::class, 'show'])->name('mentorships.show');
    Route::post('/mentorships/{mentorship}/respond', [TeacherMentorship::class, 'respond'])->name('mentorships.respond');

    // Placeholder
    Route::get('/profile', fn() => view('teacher.profile'))->name('profile');
    Route::get('/settings', fn() => redirect()->route('teacher.profile'))->name('settings');

    // Notif
    Route::post('/notifications/{id}/read', [TeacherNotif::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [TeacherNotif::class, 'readAll'])->name('notifications.readAll');
});

// ==================================================
// ADMIN & DEVELOPER ROUTES
// ==================================================
Route::middleware(['auth', 'role:admin,developer'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Users
    Route::get('/users', [AdminUser::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUser::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUser::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminUser::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUser::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUser::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/toggle-active', [AdminUser::class, 'toggleActive'])->name('users.toggle');

    // Competitions
    Route::get('/competitions', [AdminCompetition::class, 'index'])->name('competitions.index');
    Route::get('/competitions/create', [AdminCompetition::class, 'create'])->name('competitions.create');
    Route::post('/competitions', [AdminCompetition::class, 'store'])->name('competitions.store');
    Route::get('/competitions/{competition}/edit', [AdminCompetition::class, 'edit'])->name('competitions.edit');
    Route::put('/competitions/{competition}', [AdminCompetition::class, 'update'])->name('competitions.update');
    Route::delete('/competitions/{competition}', [AdminCompetition::class, 'destroy'])->name('competitions.destroy');
    Route::post('/competitions/{competition}/toggle', [AdminCompetition::class, 'toggleActive'])->name('competitions.toggle');

    // Categories
    Route::get('/categories', [AdminCategory::class, 'index'])->name('categories.index');
    Route::post('/categories', [AdminCategory::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [AdminCategory::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategory::class, 'destroy'])->name('categories.destroy');

    // Fields
    Route::get('/fields', [AdminField::class, 'index'])->name('fields.index');
    Route::post('/fields', [AdminField::class, 'store'])->name('fields.store');
    Route::put('/fields/{field}', [AdminField::class, 'update'])->name('fields.update');
    Route::delete('/fields/{field}', [AdminField::class, 'destroy'])->name('fields.destroy');

    // Leaderboard
    Route::get('/leaderboard', fn() => view('admin.leaderboard'))->name('leaderboard');

    // Notifications
    Route::post('/notifications/{id}/read', [AdminNotif::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [AdminNotif::class, 'readAll'])->name('notifications.readAll');
});

Route::middleware(['auth', 'role:developer'])->prefix('developer')->name('developer.')->group(function () {
    Route::get('/dashboard', [DeveloperDashboard::class, 'index'])->name('dashboard');
});