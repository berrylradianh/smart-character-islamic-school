<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Landing\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/profile', [LandingController::class, 'profile'])->name('landing.profile');
Route::get('/vision', [LandingController::class, 'vision'])->name('landing.vision');
Route::get('/program', [LandingController::class, 'program'])->name('landing.program');
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/content-hero', [AdminController::class, 'hero'])->name('admin.hero');
    Route::get('/content-news', [AdminController::class, 'news'])->name('admin.news');
    Route::get('/content-agenda', [AdminController::class, 'agenda'])->name('admin.agenda');
});
