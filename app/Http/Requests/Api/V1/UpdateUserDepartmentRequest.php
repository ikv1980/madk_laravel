<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserDepartmentRequest extends FormRequest
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
            'department_name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                Rule::unique('user_departments', 'department_name')->ignore($this->user_department->id),
            ],
            'department_description' => [
                'required',
                'string',
                'min:3',
            ],
            'department_mail' => [
                'required',
                'string',
                'email:rfc',
                'min:3',
                'max:100',
                Rule::unique('user_departments', 'department_mail')->ignore($this->user_department->id),
            ],
        ];
    }
}
