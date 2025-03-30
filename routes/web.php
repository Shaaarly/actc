<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('/login', function () {
    return view('users.index');
})->name('login');
Route::get('/users', function () {
    return view('users.show');
})->name('users');
Route::resource('users', UserController::class);



Route::get('/dashboard', function () {
    return view('dashboard.show');
})->name('dashboard');
Route::get('/leases', function () {
    return view('leases.show');
})->name('leases');
Route::get('/properties', function () {
    return view('properties.show');
})->name('properties');
Route::get('/finances', function () {
    return view('finances.show');
})->name('finances');
Route::get('/payments', function () {
    return view('payments.show');
})->name('payments');
Route::get('/contracts', function () {
    return view('contracts.show');
})->name('contracts');
Route::get('/bills', function () {
    return view('bills.show');
})->name('bills');
Route::get('/logs', function () {
    return view('logs.show');
})->name('logs');