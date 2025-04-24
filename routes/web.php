<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\FortifyAuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\SessionController;
use App\Mail\TestEmail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Public routes (guests only), plus auth-protected and role-protected groups.
|
*/

Route::view('/', 'welcome')->name('welcome');

// Guest-only pages: welcome, login, register, password reset
Route::middleware('guest')->group(function () {
    // Home (public)
});

// All authenticated users
Route::middleware(['auth', '2fa.prompt'])->group(function () {
    // Dashboard (any logged-in user)
    
    Route::get('/leased', [LeaseController::class, 'leased'])->name('leased');

    // Perfil general
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [UserController::class, 'destroyProfile'])->name('profile.destroy');


    Route::get('/configuracion/{tab?}', [UserController::class, 'settings'])->name('configuracion');

    // Configuración del 2FA
    Route::get('/two-factor/setup', function () {
        return view('auth.two-factor-setup'); // Vista simple, o podrías redirigir a una sección del perfil
    })->name('two-factor.setup');

    // Vista de sesiones activas
    Route::get('/profile/sessions', [SessionController::class, 'index'])->name('sessions.index');

    // Cerrar una sesión específica
    Route::delete('/profile/sessions/{id}', [SessionController::class, 'destroy'])->name('sessions.destroy');

    Route::put('/notificaciones', [UserController::class, 'updateNotifications'])->name('notifications.update');



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
        Route::view('/insurances', 'insurances.show')->name('insurances');

        // Test mail (admin-only)
        Route::get('/test-mail', function () {
            Mail::to('destinatario@example.com')->send(new TestEmail());
            return 'Correo enviado';
        })->name('test.mail');
    });
});
