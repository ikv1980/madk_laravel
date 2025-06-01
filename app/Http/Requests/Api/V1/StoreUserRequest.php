<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // Проверяем, имеет ли пользователь право создавать пользователей
        // return auth()->check() && auth()->user()->hasPermission('create_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => [
                'required',
                'string',
                'max:50',
                'unique:users,login',
            ],
            'password' => [
                'required',
                'string',
                'min:8'
            ],
            'name' => [
                'required',
                'string',
                'max:50'
            ],
            'surname' => [
                'required',
                'string',
                'max:50'
            ],
            'patronymic' => [
                'nullable',
                'string',
                'max:50'
            ],
            'email' => [
                'nullable',
                'email',
                'unique:users,email',
                'max:50'
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],
            'birthday' => [
                'nullable',
                'date'
            ],
            'department_id' => [
                'nullable',
                'exists:user_departments,id'
            ],
            'position_id' => [
                'nullable',
                'exists:user_positions,id'
            ],
            'start_work' => [
                'nullable',
                'date'
            ],
            'status_id' => [
                'nullable',
                'exists:user_statuses,id'
            ],
            'status_at' => [
                'nullable',
                'date'
            ],
            'permissions' => [
                'nullable',
                'array'
            ],
        ];
    }
}
