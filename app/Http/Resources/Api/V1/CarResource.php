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
            'mark_model_country_id' => $this->mark_model_country_id,
            'mark' => $this->whenLoaded('markModelCountry', function () {
                return [
                    'id' => $this->markModelCountry?->mark?->id,
                    'name' => $this->markModelCountry?->mark?->mark_name,
                ];
            }),
            'model' => $this->whenLoaded('markModelCountry', function () {
                return [
                    'id' => $this->markModelCountry?->model?->id,
                    'name' => $this->markModelCountry?->model?->model_name,
                ];
            }),
            'country' => $this->whenLoaded('markModelCountry', function () {
                return [
                    'id' => $this->markModelCountry?->country?->id,
                    'name' => $this->markModelCountry?->country?->country_name,
                ];
            }),
            'type' => $this->whenLoaded('type', function () {
                return [
                    'id' => $this->type?->id,
                    'name' => $this->type?->type_name,
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
            'date_at' => Carbon::parse($this->date_at)->format('Y-m-d H:i:s'),
            'photos' => $this->photos,
        ];
    }
}
