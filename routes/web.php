<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

// ─── Customer Routes ─────────────────────────────────────────────────────────
Route::get('/', [BookingController::class, 'index'])->name('home');
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::match(['get', 'post'], '/cek-antrian', [BookingController::class, 'checkQueue'])->name('booking.check');

// ─── Queue Display (TV) ───────────────────────────────────────────────────────
Route::get('/queue', [QueueController::class, 'display'])->name('queue.display');

// ─── Admin Auth ───────────────────────────────────────────────────────────────
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// ─── Admin Protected Routes ───────────────────────────────────────────────────
Route::middleware(AdminAuth::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/next', [AdminController::class, 'callNext'])->name('next');
    Route::post('/booking/{booking}/status', [AdminController::class, 'updateStatus'])->name('booking.status');
    Route::get('/bookings', [AdminController::class, 'allBookings'])->name('bookings');

    // Services CRUD
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
});
