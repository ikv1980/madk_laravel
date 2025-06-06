<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->surname . ' ' . $this->user->firstname,
                    'department' => $this->user->department?->department_name,
                    'position' => $this->user->position?->position_name,
                    'phone' => $this->user->phone,
                ];
            }),
            'client' => $this->whenLoaded('client', function () {
                return (new ClientResource($this->client))->only(['id', 'client_name', 'client_phone']);
            }),
            'payment' => $this->whenLoaded('payment', function () {
                return [
                    'id' => $this->payment->id,
                    'name' => $this->payment->payment_name,
                ];
            }),
            'delivery' => $this->whenLoaded('delivery', function () {
                return [
                    'id' => $this->delivery->id,
                    'delivery' => $this->delivery->delivery_name,
                ];
            }),
            // Только для просмотра одного заказа
            'statuses' => $this->when(
                request()->routeIs('orders.show') && $this->whenLoaded('statuses'),
                function () {
                    return $this->statuses->map(function ($status) {
                        return [
                            'id' => $status->id,
                            'status_name' => $status->status_name,
                            'created_at' => formatDate($status->created_at),
                        ];
                    });
                }),
            // Только для просмотра одного заказа
            'cars' => $this->when(request()->routeIs('orders.show'), function () {
                return $this->cars->map(function ($car) {
                    return [
                        'id' => $car?->id,
                        'car' =>
                            $car?->mark->mark_name . ' ' .
                            $car?->model->model_name . ' (цвет: ' .
                            $car?->color?->color_name . ')',
                    ];
                });
            }),
            'delivery_address' => $this->delivery_address,
            'created_at' => formatDate($this->created_at),
            'updated_at' => formatDate($this->updated_at),
        ];
    }
}
