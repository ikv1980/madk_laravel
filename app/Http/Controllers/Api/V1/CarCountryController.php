<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarCountryRequest;
use App\Http\Requests\Api\V1\UpdateCarCountryRequest;
use App\Http\Resources\Api\V1\CarCountryResource;
use App\Models\CarCountry;

class CarCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarCountryResource::collection(CarCountry::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarCountryRequest $request)
    {
        try {
            return new CarCountryResource(CarCountry::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarCountry $carCountry)
    {
        return new CarCountryResource($carCountry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarCountryRequest $request, CarCountry $carCountry)
    {
        try {
            $carCountry->update($request->validated());
            return new CarCountryResource($carCountry);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarCountry $carCountry)
    {
        try {
            // Мягкое удаление
            $carCountry->delete();
            // Жесткое удаление
            // $carCountry->forceDelete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Обработка исключения
            return response()->json(['error' => 'Ошибка при удалении: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $id)
    {
        $carCountry = CarCountry::withTrashed()->findOrFail($id);

        if (!$carCountry->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $carCountry->restore();

        return new CarCountryResource($carCountry);
    }
}
