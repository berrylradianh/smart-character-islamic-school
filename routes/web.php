<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Landing\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/profile', [LandingController::class, 'profile'])->name('landing.profile');
Route::get('/vision', [LandingController::class, 'vision'])->name('landing.vision');
Route::get('/program', [LandingController::class, 'program'])->name('landing.program');
Route::match(['get', 'post'], '/ppdb', [LandingController::class, 'ppdb'])->name('ppdb');
Route::get('/search', [LandingController::class, 'search'])->name('landing.search');
Route::get('/search-suggestions', [LandingController::class, 'searchSuggestions'])->name('landing.search.suggestions');

// Auth
Route::prefix('auth')->group(function () {
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('auth.login');
    Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Dashboard
Route::prefix('dashboards')->middleware('auth', 'check.profile')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [AdminController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/ppdb-information', [AdminController::class, 'ppdb_info'])->name('dashboard.ppdb_info');
    Route::get('/ppdb-timeline', [AdminController::class, 'ppdb_timeline'])->name('dashboard.ppdb_timeline');
    Route::post('/ppdb-pendaftaran/store', [AdminController::class, 'storeRegistration'])->name('dashboard.ppdb_pendaftaran.store');
    Route::get('/ppdb-faq', [AdminController::class, 'ppdb_faq'])->name('dashboard.ppdb_faq');

    // Routes accessible to User
    Route::middleware('role:User')->group(function () {
        Route::get('/ppdb-pendaftaran', [AdminController::class, 'ppdb_pendaftaran'])->name('dashboard.ppdb_pendaftaran');
    });

    // Routes accessible to Admin and Superadmin
    Route::middleware('role:Admin,Superadmin')->group(function () {
        Route::get('/stats', [AdminController::class, 'stats'])->name('dashboard.stats');
        Route::post('/stats', [AdminController::class, 'storeStat'])->name('dashboard.stats.store');
        Route::put('/stats/{id}', [AdminController::class, 'updateStat'])->name('dashboard.stats.update');
        Route::delete('/stats/{id}', [AdminController::class, 'destroyStat'])->name('dashboard.stats.destroy');
        Route::get('/content-hero', [AdminController::class, 'hero'])->name('dashboard.hero');
        Route::post('/content-hero', [AdminController::class, 'storeHero'])->name('dashboard.hero.store');
        Route::delete('/content-hero/{id}', [AdminController::class, 'destroyHero'])->name('dashboard.hero.destroy');
        Route::get('/content-news', [AdminController::class, 'news'])->name('dashboard.news');
        Route::post('/content-news', [AdminController::class, 'storeNews'])->name('dashboard.news.store');
        Route::delete('/content-news/{id}', [AdminController::class, 'destroyNews'])->name('dashboard.news.destroy');
        Route::get('/content-agenda', [AdminController::class, 'agenda'])->name('dashboard.agenda');
        Route::post('/content-agenda', [AdminController::class, 'storeAgenda'])->name('dashboard.agenda.store');
        Route::delete('/content-agenda/{id}', [AdminController::class, 'destroyAgenda'])->name('dashboard.agenda.destroy');
        Route::get('/requirement-information', [AdminController::class, 'requirement_information'])->name('dashboard.requirement_information');
        Route::post('/requirement-information', [AdminController::class, 'storeRequirementInformation'])->name('dashboard.requirement_information.store');
        Route::get('/requirement-information/{id}/edit', [AdminController::class, 'editRequirementInformation'])->name('dashboard.requirement_information.edit');
        Route::put('/requirement-information/{id}', [AdminController::class, 'updateRequirementInformation'])->name('dashboard.requirement_information.update');
        Route::delete('/requirement-information/{id}', [AdminController::class, 'destroyRequirementInformation'])->name('dashboard.requirement_information.destroy');
        Route::post('/levels', [AdminController::class, 'storeLevel'])->name('dashboard.levels.store');
        Route::delete('/levels/{id}', [AdminController::class, 'destroyLevel'])->name('dashboard.levels.destroy');
        Route::get('/requirement-timeline', [AdminController::class, 'requirement_timeline'])->name('dashboard.requirement_timeline');
        Route::post('/requirement-timeline', [AdminController::class, 'storeTimeline'])->name('dashboard.requirement_timeline.store');
        Route::post('/requirement-timeline/add', [AdminController::class, 'addTimeline'])->name('dashboard.requirement_timeline.add');
        Route::get('/requirement-timeline/{id}/edit', [AdminController::class, 'editTimeline'])->name('dashboard.requirement_timeline.edit');
        Route::put('/requirement-timeline/{id}', [AdminController::class, 'updateTimeline'])->name('dashboard.requirement_timeline.update');
        Route::delete('/requirement-timeline/{id}', [AdminController::class, 'destroyTimeline'])->name('dashboard.requirement_timeline.destroy');
        Route::get('/requirement-faq', [AdminController::class, 'requirementFaq'])->name('dashboard.requirement_faq');
        Route::post('/requirement-faq', [AdminController::class, 'storeFaq'])->name('dashboard.faq.store');
        Route::put('/requirement-faq/{id}', [AdminController::class, 'updateFaq'])->name('dashboard.faq.update');
        Route::delete('/requirement-faq/{id}', [AdminController::class, 'destroyFaq'])->name('dashboard.faq.destroy');
        Route::get('/list-pendaftar', [AdminController::class, 'listPendaftar'])->name('dashboard.list_pendaftar');
        Route::get('/pendaftar/{id}', [AdminController::class, 'showPendaftar'])->name('dashboard.show_pendaftar');
        Route::post('/pendaftar/{id}/update-status', [AdminController::class, 'updateStatus'])->name('dashboard.update_status');
        Route::get('/export/{format}', [AdminController::class, 'export'])->name('dashboard.export');
    });

    // Routes accessible only to Superadmin
    Route::middleware('role:Superadmin')->group(function () {
        Route::get('/roles', [AdminController::class, 'listRoles'])->name('dashboard.roles.index');
        Route::get('/roles/create', [AdminController::class, 'createRole'])->name('dashboard.roles.create');
        Route::post('/roles', [AdminController::class, 'storeRole'])->name('dashboard.roles.store');
        Route::get('/roles/{id}', [AdminController::class, 'showRole'])->name('dashboard.roles.show');
        Route::get('/roles/{id}/edit', [AdminController::class, 'editRole'])->name('dashboard.roles.edit');
        Route::put('/roles/{id}', [AdminController::class, 'updateRole'])->name('dashboard.roles.update');
        Route::delete('/roles/{id}', [AdminController::class, 'destroyRole'])->name('dashboard.roles.destroy');
        Route::get('/users', [AdminController::class, 'listUsers'])->name('dashboard.users.index');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('dashboard.users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('dashboard.users.store');
        Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('dashboard.users.show');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('dashboard.users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('dashboard.users.update');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('dashboard.users.destroy');
    });
});
