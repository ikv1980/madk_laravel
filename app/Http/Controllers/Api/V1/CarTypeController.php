<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCarTypeRequest;
use App\Http\Requests\Api\V1\UpdateCarTypeRequest;
use App\Http\Resources\Api\V1\CarTypeResource;
use App\Models\CarType;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarTypeResource::collection(CarType::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarTypeRequest $request)
    {
        try {
            return new CarTypeResource(CarType::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarType $carType)
    {
        return new CarTypeResource($carType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarTypeRequest $request, CarType $carType)
    {
        try {
            $carType->update($request->validated());
            return new CarTypeResource($carType);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarType $carType)
    {
        // Мягкое удаление
        $carType->delete();
        // Жесткое удаление
        // $carType->forceDelete();
        return response()->json(null, 204);
    }

    public function restore(int $id): CarTypeResource
    {
        $carType = CarType::withTrashed()->findOrFail($id);

        if (!$carType->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $carType->restore();

        return new CarTypeResource($carType);
    }
}
