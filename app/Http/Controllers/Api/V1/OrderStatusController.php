<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreOrderStatusRequest;
use App\Http\Requests\Api\V1\UpdateOrderStatusRequest;
use App\Http\Resources\Api\V1\OrderStatusResource;
use App\Http\Resources\Api\V1\OrderResource;
use App\Http\Resources\Api\V1\StatusResource;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Status;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderStatusResource::collection(OrderStatus::with(['order', 'status'])->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderStatusRequest $request)
    {
        try {
            $orderStatus = OrderStatus::create($request->validated());
            return new OrderStatusResource($orderStatus->load(['order', 'status']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось создать запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderStatus $orderStatus)
    {
        return new OrderStatusResource($orderStatus->load(['order', 'status']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderStatusRequest $request, OrderStatus $orderStatus)
    {
        try {
            $orderStatus->update($request->validated());
            return new OrderStatusResource($orderStatus->load(['order', 'status']));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось обновить запись: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderStatus $orderStatus)
    {
        try {
            // Мягкое удаление
            $orderStatus->delete();
            // Жесткое удаление
            // $orderStatus->forceDelete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Обработка исключения
            return response()->json(['error' => 'Ошибка при удалении: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Список всех статусов в заказе.
     */
    public function getStatusesByOrder(Order $order)
    {
        return StatusResource::collection(
            $order
                ->statuses()
                ->get()
        );
    }

    /**
     * Список заказов, имеющих определенный статус.
     */
    public function getOrdersByStatus(Status $status)
    {
        return OrderResource::collection(
            $status
                ->orders()
                ->get()
        );
    }
}
