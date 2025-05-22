<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarMarkModelCountryResource extends JsonResource
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
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
