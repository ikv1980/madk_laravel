<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'mark' => $this->whenLoaded('mark', function () {
                return [
                    'id' => $this->mark?->id,
                    'name' => $this->mark?->mark_name,
                ];
            }),
            'model' => $this->whenLoaded('model', function () {
                return [
                    'id' => $this->model?->id,
                    'name' => $this->model?->model_name,
                ];
            }),
            'country' => $this->whenLoaded('country', function () {
                return [
                    'id' => $this->country?->id,
                    'name' => $this->country?->country_name,
                ];
            }),
            'type' => $this->whenLoaded('type', function () {
                return [
                    'id' => $this->type->id,
                    'name' => $this->type->type_name,
                ];
            }),
            'color' => $this->whenLoaded('color', function () {
                return [
                    'id' => $this->color?->id,
                    'name' => $this->color?->color_name,
                ];
            }),
            'vin' => $this->vin,
            'pts' => $this->pts,
            'price' => $this->price,
            'block' => $this->block,
            'date_at' => formatDate($this->date_at),
            'photos' => $this->photos,
        ];
    }
}
