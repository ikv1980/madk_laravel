<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreOrderCarRequest;
use App\Http\Requests\Api\V1\UpdateOrderCarRequest;
use App\Http\Resources\Api\V1\CarResource;
use App\Http\Resources\Api\V1\OrderCarResource;
use App\Http\Resources\Api\V1\OrderResource;
use App\Models\Car;
use App\Models\Order;
use App\Models\OrderCar;

class OrderCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderCarResource::collection(OrderCar::with(['order', 'car'])->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderCarRequest $request)
    {
        try {
            $orderCar = OrderCar::create($request->validated());
            return new OrderCarResource($orderCar->load(['order', 'car']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderCar $orderCar)
    {
        return new OrderCarResource($orderCar->load(['order', 'car']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderCarRequest $request, OrderCar $orderCar)
    {
        try {
            $orderCar->update($request->validated());
            return new OrderCarResource($orderCar->load(['order', 'car']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderCar $orderCar)
    {
        try {
            // Мягкое удаление
            $orderCar->delete();
            // Жесткое удаление
            // $orderCar->forceDelete();
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
        $orderCar = OrderCar::withTrashed()->findOrFail($id);

        if (!$orderCar->trashed()) {
            return response()->json(['message' => 'Запись не удалена'], 400);
        }

        $orderCar->restore();

        return new OrderCarResource($orderCar->load(['order', 'car']));
    }

    /**
     * Список всех автомобилей в заказе.
     */
    public function getCarsByOrder(Order $order)
    {
        return CarResource::collection(
            $order
                ->cars()
                ->get()
        );
    }

    /**
     * Список заказов, имеющих в составе указанный автомобиль должность.
     */
    public function getOrdersByCar(Car $car)
    {
        return OrderResource::collection(
            $car
                ->orders()
                ->get()
        );
    }
}
