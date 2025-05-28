<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderCarResource extends JsonResource
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
            'order' => $this->whenLoaded('order', function () {
                $user = $this->order->user;
                return [
                    'id' => $this->order->id,
                    'client' => $this->order->client?->client_name,
                    'user' => $user ? ($user->name . ' ' . $user->surname) : null,
                    'last_status' => $this->whenLoaded('order.lastStatus', function () {
                        return $this->order->lastStatus->map(function ($status) {
                            return [
                                'id' => $status->id,
                                'status_name' => $status->status_name,
                                'created_at' => formatDate($status->pivot->created_at),
                            ];
                        });
                    }),
                    'delivery' => $this->order->delivery?->delivery_name,
                    'payment' => $this->order->payment?->payment_name,
                ];
            }),

            'car' => $this->whenLoaded('car', function () {
                return [
                    'id' => $this->car->id,
                    'color' => $this->car->color?->color_name,
                    'mark' => $this->car->markModelCountry?->mark?->mark_name,
                    'model' => $this->car->markModelCountry?->model?->model_name,
                ];
            }),

            'created_at' => formatDate($this->created_at),
            'updated_at' => formatDate($this->updated_at),
        ];
    }
}
