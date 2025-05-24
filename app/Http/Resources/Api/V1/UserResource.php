<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'login' => $this->login,
            //'password' => $this->password,

            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,

            'email' => $this->email,
            'phone' => $this->phone,
            'birthday' => Carbon::parse($this->birthday)->format('Y-m-d'),

            'start_work' => Carbon::parse($this->start_work)->format('Y-m-d'),

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
            'status' => $this->whenLoaded('status', function () {
                return [
                    'id' => $this->status?->id,
                    'name' => $this->status?->status_name,
                    'status_at' => Carbon::parse($this->status_at)->format('Y-m-d'),
                ];
            }),

            'permissions' => $this->permissions,

            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
