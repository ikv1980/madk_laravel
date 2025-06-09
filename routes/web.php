<?php

use App\Http\Controllers\Main\CarTypeController;
use App\Http\Controllers\Main\IndexController;
use Illuminate\Support\Facades\Route;

// Администраторская панель
Route::get('/', IndexController::class);


Route::resource('car-types', CarTypeController::class);

