<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarModelRequest;
use App\Http\Requests\Api\V1\UpdateCarModelRequest;
use App\Http\Resources\Api\V1\CarModelResource;
use App\Models\CarModel;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarModelResource::collection(CarModel::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarModelRequest $request)
    {
        try {
            return new CarModelResource(CarModel::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $carModel)
    {
        return new CarModelResource($carModel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarModelRequest $request, CarModel $carModel)
    {
        try {
            $carModel->update($request->validated());
            return new CarModelResource($carModel);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carModel)
    {
        try {
            // Мягкое удаление
            $carModel->delete();
            // Жесткое удаление
            // $carModel->forceDelete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Обработка исключения
            return response()->json(['error' => 'Ошибка при удалении: ' . $e->getMessage()], 500);
        }
    }

    public function restore(int $id): CarModelResource
    {
        $carModel = CarModel::withTrashed()->findOrFail($id);

        if (!$carModel->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $carModel->restore();

        return new CarModelResource($carModel);
    }
}
