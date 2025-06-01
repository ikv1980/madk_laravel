<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'firstname' => [
                'required',
                'string',
                'max:50'
            ],
            'surname' => [
                'required',
                'string',
                'max:50'
            ],
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
        ];
    }
}
