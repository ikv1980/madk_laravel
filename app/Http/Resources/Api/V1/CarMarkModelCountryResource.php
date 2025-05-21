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
            'mark_id' => $this->mark_id,
            //'mark_name' => $this->mark->mark_name,
            'mark_name' => $this->whenLoaded('mark', function () {
                return $this->mark?->mark_name;
            }),

            'model_id' => $this->model_id,
            //'model_name' => $this->model->model_name,
            'model_name' => $this->whenLoaded('model', function () {
                return $this->model?->model_name;
            }),
            'country_id' => $this->country_id,
            //'country_name' => $this->country->country_name,
            'country_name' => $this->whenLoaded('country', function () {
                return $this->country?->country_name;
            }),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
