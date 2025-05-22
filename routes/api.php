<?php

use App\Http\Controllers\Api\V1\CarColorController;
use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\CarCountryController;
use App\Http\Controllers\Api\V1\CarMarkController;
use App\Http\Controllers\Api\V1\CarMarkModelCountryController;
use App\Http\Controllers\Api\V1\CarModelController;
use App\Http\Controllers\Api\V1\CarPhotoController;
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
        'cars' => CarController::class,
        'car-colors' => CarColorController::class,
        'car-countries' => CarCountryController::class,
        'car-marks' => CarMarkController::class,
        'car-models' => CarModelController::class,
        'car-mark-model-countries' => CarMarkModelCountryController::class,
        'car-types' => CarTypeController::class,
        'car-photos' => CarPhotoController::class,
    ]);
    // Маршруты для восстановления записей
    Route::patch('cars/{id}/restore', [CarController::class, 'restore']);
    Route::patch('car-colors/{id}/restore', [CarColorController::class, 'restore']);
    Route::patch('car-counties/{id}/restore', [CarCountryController::class, 'restore']);
    Route::patch('car-marks/{id}/restore', [CarMarkController::class, 'restore']);
    Route::patch('car-models/{id}/restore', [CarModelController::class, 'restore']);
    Route::patch('car-types/{id}/restore', [CarTypeController::class, 'restore']);

    // Маршруты для фотографий автомобиля
    Route::get('cars/{car}/photos', [CarPhotoController::class, 'showByCar']);
});

