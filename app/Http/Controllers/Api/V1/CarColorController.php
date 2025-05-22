<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarColorRequest;
use App\Http\Requests\Api\V1\UpdateCarColorRequest;
use App\Http\Resources\Api\V1\CarColorResource;
use App\Models\CarColor;

class CarColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarColorResource::collection(CarColor::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarColorRequest $request)
    {
        try {
            return new CarColorResource(CarColor::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarColor $carColor)
    {
        return new CarColorResource($carColor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarColorRequest $request, CarColor $carColor)
    {
        try {
            $carColor->update($request->validated());
            return new CarColorResource($carColor);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarColor $carColor)
    {
        try {
            // Мягкое удаление
            $carColor->delete();
            // Жесткое удаление
            // $carColor->forceDelete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Обработка исключения
            return response()->json(['error' => 'Ошибка при удалении: ' . $e->getMessage()], 500);
        }
    }

    public function restore(int $id): CarColorResource
    {
        $carColor = CarColor::withTrashed()->findOrFail($id);

        if (!$carColor->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $carColor->restore();

        return new CarColorResource($carColor);
    }
}
