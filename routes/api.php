<?php

use App\Http\Controllers\Api\V1\CarColorController;
use App\Http\Controllers\Api\V1\CarCountryController;
use App\Http\Controllers\Api\V1\CarTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::apiResources([
        # Laravel автоматически создает имена маршрутов:
        # GET /api/v1/car-colors → api.v1.car-colors.index
        'car-colors' => CarColorController::class,
        'car-countries' => CarCountryController::class,
        'car-types' => CarTypeController::class,
    ]);
    // Маршруты для восстановления записей
    Route::patch('car-colors/{id}/restore', [CarColorController::class, 'restore']);
    Route::patch('car-counties/{id}/restore', [CarCountryController::class, 'restore']);
    Route::patch('car-types/{id}/restore', [CarTypeController::class, 'restore']);
});

