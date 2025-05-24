<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
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
            'client_name' => [
                'required',
                'string',
                'unique:clients,client_name',
            ],
            'client_mail' => [
                'required',
                'email',
                'max:50',
                'unique:clients,client_mail',
            ],
            'client_phone' => [
                'required',
                'string',
                'max:20',
                'unique:clients,client_phone',
            ],
            'client_address' => [
                'nullable',
                'string',
                'min:3',
            ],
            'client_add_data' => [
                'nullable',
                'string',
                'min:3',
            ],
            'client_status' => [
                'required',
                'boolean',
            ],
        ];
    }
}
