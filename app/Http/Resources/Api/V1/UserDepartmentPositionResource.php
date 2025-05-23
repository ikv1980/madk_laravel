<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDepartmentPositionResource extends JsonResource
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
            'department' => $this->whenLoaded('department', function () {
                return [
                    'id' => $this->department?->id,
                    'name' => $this->department?->department_name,
                ];
            }),
            'position' => $this->whenLoaded('position', function () {
                return [
                    'id' => $this->position?->id,
                    'name' => $this->position?->position_name,
                ];
            }),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
