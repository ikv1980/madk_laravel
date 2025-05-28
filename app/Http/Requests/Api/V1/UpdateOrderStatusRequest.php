<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderStatusRequest extends FormRequest
{
    /**
     * Determine if the is authorized to make this request.
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
                Rule::unique('order_statuses')
                    ->where(function ($query) {
                        return $query
                            ->where('status_id', $this->status_id);
                    })
                    ->ignore($this->order_status->id),
            ],
            'status_id' => [
                'required',
                'integer',
                'exists:statuses,id',
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
            'order_id.unique' => 'Эта комбинация order_id и status_id уже существует в базе данных.',
        ];
    }
}
