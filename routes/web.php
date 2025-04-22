<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\FortifyAuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LeaseController;
use App\Mail\TestEmail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Public routes (guests only), plus auth-protected and role-protected groups.
|
*/

// Guest-only pages: welcome, login, register, password reset
Route::middleware('guest')->group(function () {
    // Home (public)
    Route::view('/', 'welcome')->name('welcome');
});

// All authenticated users
Route::middleware('auth')->group(function () {
    // Dashboard (any logged-in user)
    Route::view('/', 'welcome')->name('welcome');
    
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    // Routes only for owners (role_id 2) and admins (role_id 3)
    Route::middleware('role:2,3')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('properties', PropertyController::class);
        Route::resource('leases', LeaseController::class);

        // Finance-related views
        Route::view('/dashboard', 'dashboard.show')->name('dashboard');
        Route::view('/finances', 'finances.show')->name('finances');
        Route::view('/payments', 'payments.show')->name('payments');
        Route::view('/expenses', 'expenses.show')->name('expenses');
        Route::view('/contracts', 'contracts.show')->name('contracts');
        Route::view('/bills', 'bills.show')->name('bills');
        Route::view('/logs', 'logs.show')->name('logs');

        // Test mail (admin-only)
        Route::get('/test-mail', function () {
            Mail::to('destinatario@example.com')->send(new TestEmail());
            return 'Correo enviado';
        })->name('test.mail');
    });
});
