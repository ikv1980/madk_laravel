<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
            'client_id' => [
                'required',
                'integer',
                'exists:clients,id',
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'payment_id' => [
                'required',
                'integer',
                'exists:payments,id',
            ],
            'delivery_id' => [
                'required',
                'integer',
                'exists:deliveries,id',
            ],
            'delivery_address' => [
                'sometimes',
                'string',
                'min:3',
            ],
        ];
    }

    /**
     * Кастомное сообщение об уникальности связки полей
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'department_id.unique' => 'Эта комбинация department_id и position_id уже существует в базе данных.',
        ];
    }
}
