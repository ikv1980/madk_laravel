<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderCarRequest extends FormRequest
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
            'order_id' => [
                'required',
                'integer',
                'exists:orders,id',
                Rule::unique('order_cars')
                    ->where(function ($query) {
                        return $query
                            ->where('car_id', $this->car_id);
                    }),
            ],
            'car_id' => [
                'required',
                'integer',
                'exists:cars,id',
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
            'order_id.unique' => 'Эта комбинация order_id и car_id уже существует в базе данных.',
        ];
    }
}
