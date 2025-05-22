<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarRequest;
use App\Http\Requests\Api\V1\UpdateCarRequest;
use App\Http\Resources\Api\V1\CarResource;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarResource::collection(Car::with(['markModelCountry.mark', 'markModelCountry.model', 'markModelCountry.country', 'type', 'color', 'photos'])->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        try {
            return new CarResource(Car::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return new CarResource($car->load(['markModelCountry.mark', 'markModelCountry.model', 'markModelCountry.country', 'type', 'color', 'photos']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        try {
            $car->update($request->validated());
            return new CarResource($car->load(['markModelCountry.mark', 'markModelCountry.model', 'markModelCountry.country', 'type', 'color', 'photos']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        try {
            // Мягкое удаление
            $car->delete();
            // Жесткое удаление
            // $car->forceDelete();
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
        $car = Car::withTrashed()->findOrFail($id);

        if (!$car->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $car->restore();

        return new CarResource($car);
    }
}
