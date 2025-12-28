<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BusinessController as UserBusinessController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BusinessController as AdminBusinessController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/business/{id}', [HomeController::class, 'getBusinessDetail'])->name('business.detail');
Route::get('/search', [HomeController::class, 'search'])->name('business.search');

// Guest Routes (Authentication)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/verification', [AuthController::class, 'showVerification'])->name('verification.show');
    Route::post('/verification', [AuthController::class, 'verify'])->name('verification.verify');
    Route::post('/verification/resend', [AuthController::class, 'resendCode'])->name('verification.resend');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User Routes (Pelaku Usaha)
    Route::middleware(\App\Http\Middleware\UserMiddleware::class)->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        
        Route::prefix('business')->name('business.')->group(function () {
            Route::get('/create', [UserBusinessController::class, 'create'])->name('create');
            Route::post('/', [UserBusinessController::class, 'store'])->name('store');
            Route::get('/{id}', [UserBusinessController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [UserBusinessController::class, 'edit'])->name('edit');
            Route::put('/{id}', [UserBusinessController::class, 'update'])->name('update');
            Route::delete('/{id}', [UserBusinessController::class, 'destroy'])->name('destroy');
        });
    });

    // Admin Routes
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Business Management
        Route::prefix('businesses')->name('businesses.')->group(function () {
            Route::get('/', [AdminBusinessController::class, 'index'])->name('index');
            Route::get('/{id}', [AdminBusinessController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [AdminBusinessController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminBusinessController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminBusinessController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/approve', [AdminBusinessController::class, 'approve'])->name('approve');
            Route::get('/{id}/reject', [AdminBusinessController::class, 'rejectForm'])->name('reject.form');
            Route::post('/{id}/reject', [AdminBusinessController::class, 'reject'])->name('reject');
            Route::post('/bulk-approve', [AdminBusinessController::class, 'bulkApprove'])->name('bulk-approve');
            Route::post('/bulk-delete', [AdminBusinessController::class, 'bulkDelete'])->name('bulk-delete');
            Route::delete('/{businessId}/photos/{photoId}', [AdminBusinessController::class, 'deletePhoto'])->name('photo.delete');
        });

        // User Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');
            Route::post('/', [AdminUserController::class, 'store'])->name('store');
            Route::get('/{id}', [AdminUserController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminUserController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('toggle-status');
        });
    });
});
