<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarMarkRequest;
use App\Http\Requests\Api\V1\UpdateCarMarkRequest;
use App\Http\Resources\Api\V1\CarMarkResource;
use App\Models\CarMark;

class CarMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarMarkResource::collection(CarMark::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarMarkRequest $request)
    {
        try {
            return new CarMarkResource(CarMark::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarMark $carMark)
    {
        return new CarMarkResource($carMark);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarMarkRequest $request, CarMark $carMark)
    {
        try {
            $carMark->update($request->validated());
            return new CarMarkResource($carMark);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarMark $carMark)
    {
        try {
            // Мягкое удаление
            $carMark->delete();
            // Жесткое удаление
            // $carMark->forceDelete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Обработка исключения
            return response()->json(['error' => 'Ошибка при удалении: ' . $e->getMessage()], 500);
        }
    }

    public function restore(int $id): CarMarkResource
    {
        $carMark = CarMark::withTrashed()->findOrFail($id);

        if (!$carMark->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $carMark->restore();

        return new CarMarkResource($carMark);
    }
}
