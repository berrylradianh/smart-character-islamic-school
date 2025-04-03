<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Landing\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/content-hero', [AdminController::class, 'hero'])->name('admin.hero');
    Route::get('/content-introduction', [AdminController::class, 'introduction'])->name('admin.introduction');
});
