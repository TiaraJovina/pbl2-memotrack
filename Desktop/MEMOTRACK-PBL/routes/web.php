<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsensiController;

// ======== Public Routes ========
Route::get('/', fn () => view('welcome'))->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// ======== Protected Routes (hanya untuk user yang login) ========
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/notes', fn () => view('notes'))->name('notes');
    Route::get('/jadwal', fn () => view('jadwal'))->name('jadwal');
    Route::get('/tugas', fn () => view('tugas'))->name('tugas');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Absensi
    Route::get('/absensi', [AbsensiController::class, 'index']);
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi');
    Route::patch('/absensi/update/{id}', [AbsensiController::class, 'update']);
    Route::delete('/absensi/delete/{title}', [AbsensiController::class, 'delete'])->name('absensi.delete');
    Route::post('/absensi/{id}/mark', [AbsensiController::class, 'markAttendance']);

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});
