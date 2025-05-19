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
            return response()->json(['error' => 'Не удалось создать запись'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarMark $CarMark)
    {
        return new CarMarkResource($CarMark);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarMarkRequest $request, CarMark $CarMark)
    {
        try {
            $CarMark->update($request->validated());
            return new CarMarkResource($CarMark);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarMark $CarMark)
    {
        // Мягкое удаление
        $CarMark->delete();
        // Жесткое удаление
        // $CarMark->forceDelete();
        return response()->json(null, 204);
    }

    public function restore(int $id): CarMarkResource
    {
        $CarMark = CarMark::withTrashed()->findOrFail($id);

        if (!$CarMark->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $CarMark->restore();

        return new CarMarkResource($CarMark);
    }
}
