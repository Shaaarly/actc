<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\FortifyAuthController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [FortifyAuthController::class, 'login'])->name('login');
Route::get('/register', [FortifyAuthController::class, 'register'])->name('register');
Route::get('/password/reset/{token}', [FortifyAuthController::class, 'resetPassword'])
    ->name('password.reset');

// Mostrar formulario para solicitar enlace de reseteo
Route::get('/password/forgot', [PasswordController::class, 'showForgotForm'])->name('password.request.forgot');

// Procesar el envío del enlace de reseteo
Route::post('/password/email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Mostrar formulario de reset password (usado por la notificación)
Route::get('/password/reset/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');

// Procesar la actualización de la contraseña
Route::put('/password/reset', [PasswordController::class, 'update'])->name('password.update');

// Route::get('/users', function () {
//     return view('users.index');
// })->name('users');
// Route::get('/properties', function () {
//     return view('properties.index');
// })->name('properties');

Route::resources([
    'users' => UserController::class,
    'properties' => PropertyController::class,
    'leases' => LeaseController::class,
]);





Route::get('/dashboard', function () {
    return view('dashboard.show');
})->name('dashboard');

Route::get('/finances', function () {
    return view('finances.show');
})->name('finances');
Route::get('/payments', function () {
    return view('payments.show');
})->name('payments');
Route::get('/expenses', function () {
    return view('expenses.show');
})->name('expenses');
Route::get('/contracts', function () {
    return view('contracts.show');
})->name('contracts');
Route::get('/bills', function () {
    return view('bills.show');
})->name('bills');
Route::get('/logs', function () {
    return view('logs.show');
})->name('logs');




Route::get('/test-mail', function () {
    Mail::to('destinatario@example.com')->send(new TestEmail());
    return 'Correo enviado';
});