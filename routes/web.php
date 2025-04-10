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

// Auth
Route::prefix('auth')->group(function () {
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('auth.login');
    Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Dashboard Admin
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/content-hero', [AdminController::class, 'hero'])->name('admin.hero');
    Route::post('/content-hero', [AdminController::class, 'storeHero'])->name('hero.store');
    Route::delete('/content-hero/{id}', [AdminController::class, 'destroyHero'])->name('hero.destroy');
    Route::get('/content-news', [AdminController::class, 'news'])->name('admin.news');
    Route::post('/content-news', [AdminController::class, 'storeNews'])->name('news.store');
    Route::delete('/content-news/{id}', [AdminController::class, 'destroyNews'])->name('news.destroy');
    Route::get('/content-agenda', [AdminController::class, 'agenda'])->name('admin.agenda');
    Route::post('/content-agenda', [AdminController::class, 'storeAgenda'])->name('agenda.store');
    Route::delete('/content-agenda/{id}', [AdminController::class, 'destroyAgenda'])->name('agenda.destroy');
    Route::get('/ppdb-information', [AdminController::class, 'ppdb_info'])->name('admin.ppdb_info');
    Route::get('/ppdb-timeline', [AdminController::class, 'ppdb_timeline'])->name('admin.ppdb_timeline');
    Route::get('/ppdb-faq', [AdminController::class, 'ppdb_faq'])->name('admin.ppdb_faq');
    Route::get('/ppdb-pendaftaran', [AdminController::class, 'ppdb_pendaftaran'])->name('admin.ppdb_pendaftaran');
    Route::post('/ppdb-pendaftaran/store', [AdminController::class, 'storeRegistration'])->name('admin.ppdb_pendaftaran.store');
    Route::get('/list-pendaftar', [AdminController::class, 'listPendaftar'])->name('admin.list_pendaftar');
    Route::get('/pendaftar/{id}', [AdminController::class, 'showPendaftar'])->name('admin.show_pendaftar');
    Route::post('/pendaftar/{id}/update-status', [AdminController::class, 'updateStatus'])->name('admin.update_status');
});
