<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // User Dashboard
    Route::get('/dashboard', [WeatherController::class, 'index'])->name('dashboard');

    // Admin Dashboard & User Management
    Route::middleware('can:admin-access')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users/{user}/edit', [AdminDashboardController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminDashboardController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminDashboardController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
