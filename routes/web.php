<?php

use App\Http\Controllers\Main\CarTypeController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Main\UserDepartmentController;
use Illuminate\Support\Facades\Route;

// Администраторская панель
Route::get('/', IndexController::class);


Route::resource('car-types', CarTypeController::class);
Route::resource('user-departments', UserDepartmentController::class);

