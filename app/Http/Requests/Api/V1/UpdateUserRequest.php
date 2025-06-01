<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
                Rule::unique('users', 'login')->ignore($this->user->id),
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
                'max:50',
                Rule::unique('users', 'email')->ignore($this->user->id),
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
                'json'
            ],
        ];
    }
}
