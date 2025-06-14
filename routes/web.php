<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CarTypeController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\UserDepartmentController;
use App\Http\Controllers\Web\UserPositionController;
use App\Http\Controllers\Web\UserStatusController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Регистрация
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
    // Авторизация
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
});

Route::middleware('auth')->group(function () {
    // выход из системы
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    // Администраторская панель
    Route::get('/', IndexController::class)->name('home');





});





// Справочники
Route::resource('car-types', CarTypeController::class);
// Пользователи
Route::resource('users', UserPositionController::class);
Route::resource('user-departments', UserDepartmentController::class);
Route::resource('user-positions', UserPositionController::class);
Route::resource('user-statuses', UserStatusController::class);

