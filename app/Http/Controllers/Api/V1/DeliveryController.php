<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreDeliveryRequest;
use App\Http\Requests\Api\V1\UpdateDeliveryRequest;
use App\Http\Resources\Api\V1\DeliveryResource;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DeliveryResource::collection(Delivery::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryRequest $request)
    {
        try {
            return new DeliveryResource(Delivery::create($request->validated()));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        return new DeliveryResource($delivery);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryRequest $request, Delivery $delivery)
    {
        try {
            $delivery->update($request->validated());
            return new DeliveryResource($delivery);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        try {
            // Мягкое удаление
            $delivery->delete();
            // Жесткое удаление
            // $delivery->forceDelete();
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
        $delivery = Delivery::withTrashed()->findOrFail($id);

        if (!$delivery->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $delivery->restore();

        return new DeliveryResource($delivery);
    }
}
