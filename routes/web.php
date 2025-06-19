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

Route::get('dashboard/ppdb/pendaftaran/download-kartu', [AdminController::class, 'downloadKartuPeserta'])->name('dashboard.ppdb_pendaftaran.download_kartu')->middleware('auth');

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
    Route::post('/ppdb-pendaftaran/store', [AdminController::class, 'storeRegistration'])->name('dashboard.ppdb_pendaftaran.store');

    // Routes accessible to User
    Route::middleware('role:User')->group(function () {
        Route::get('/ppdb-pendaftaran', [AdminController::class, 'ppdb_pendaftaran'])->name('dashboard.ppdb_pendaftaran');
        Route::get('/ppdb-pengumuman', [AdminController::class, 'ppdb_pengumuman'])->name('dashboard.ppdb_pengumuman');
        Route::get('/ppdb-pendaftaran/revisi', [AdminController::class, 'ppdb_pendaftaran_revisi'])->name('dashboard.ppdb_pendaftaran.revisi');
        Route::put('/ppdb/pendaftaran/{id}', [AdminController::class, 'updateRegistration'])->name('dashboard.ppdb_pendaftaran.update');
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
        Route::get('/content-introduction', [AdminController::class, 'introduction'])->name('dashboard.introduction');
        Route::post('/content-introduction', [AdminController::class, 'storeIntroduction'])->name('dashboard.introduction.store');
        Route::get('/list-pendaftar', [AdminController::class, 'listPendaftar'])->name('dashboard.list_pendaftar');
        Route::get('/pendaftar/{id}', [AdminController::class, 'showPendaftar'])->name('dashboard.show_pendaftar');
        Route::post('/pendaftar/{id}/update-status', [AdminController::class, 'updateStatus'])->name('dashboard.update_status');
        Route::get('/export/{format}', [AdminController::class, 'export'])->name('dashboard.export');
        Route::post('/upload-image', [AdminController::class, 'uploadImage'])->name('dashboard.upload_image');
        Route::get('/values', [AdminController::class, 'values'])->name('dashboard.values');
        Route::put('/values/{id}', [AdminController::class, 'updateValue'])->name('dashboard.values.update');
        Route::get('/content-programs', [AdminController::class, 'programs'])->name('dashboard.programs');
        Route::post('/content-programs', [AdminController::class, 'storeProgram'])->name('dashboard.programs.store');
        Route::delete('/content-programs/{id}', [AdminController::class, 'destroyProgram'])->name('dashboard.programs.destroy');
        Route::get('/content-testimonials', [AdminController::class, 'testimonials'])->name('dashboard.testimonials');
        Route::post('/content-testimonials', [AdminController::class, 'storeTestimonial'])->name('dashboard.testimonials.store');
        Route::delete('/content-testimonials/{id}', [AdminController::class, 'destroyTestimonial'])->name('dashboard.testimonials.destroy');
        Route::get('/content-media', [AdminController::class, 'media'])->name('dashboard.media');
        Route::post('/content-media', [AdminController::class, 'storeMedia'])->name('dashboard.media.store');
        Route::delete('/content-media/{id}', [AdminController::class, 'destroyMedia'])->name('dashboard.media.destroy');
        Route::get('/content-profile', [AdminController::class, 'profile'])->name('dashboard.profile');
        Route::post('/content-profile', [AdminController::class, 'storeProfile'])->name('dashboard.profile.store');
        Route::get('/content-vision', [AdminController::class, 'vision'])->name('dashboard.vision');
        Route::post('/content-vision', [AdminController::class, 'storeVision'])->name('dashboard.vision.store');
        Route::get('/content-ppdb', [AdminController::class, 'ppdb'])->name('dashboard.ppdb');
        Route::post('/content-ppdb', [AdminController::class, 'storePpdb'])->name('dashboard.ppdb.store');
        Route::get('/get-gedungs/{school_location_id}', [AdminController::class, 'getGedungs'])->name('dashboard.get_gedungs');
        Route::get('/get-ruangs/{gedung_id}', [AdminController::class, 'getRuangs'])->name('dashboard.get_ruangs');
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
