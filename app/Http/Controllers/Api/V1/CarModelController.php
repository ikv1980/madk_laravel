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
            return response()->json(['error' => 'Не удалось создать запись'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $CarModel)
    {
        return new CarModelResource($CarModel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarModelRequest $request, CarModel $CarModel)
    {
        try {
            $CarModel->update($request->validated());
            return new CarModelResource($CarModel);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $CarModel)
    {
        // Мягкое удаление
        $CarModel->delete();
        // Жесткое удаление
        // $CarModel->forceDelete();
        return response()->json(null, 204);
    }

    public function restore(int $id): CarModelResource
    {
        $CarModel = CarModel::withTrashed()->findOrFail($id);

        if (!$CarModel->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $CarModel->restore();

        return new CarModelResource($CarModel);
    }
}
