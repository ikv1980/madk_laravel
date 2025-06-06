<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCarMarkModelCountryRequest extends FormRequest
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
            'mark_id' => [
                'required',
                'integer',
                'exists:car_marks,id',
            ],
            'model_id' => [
                'required',
                'integer',
                'exists:car_models,id',
            ],
            'country_id' => [
                'required',
                'integer',
                'exists:car_countries,id',
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
            'mark_id.unique' => 'Эта комбинация mark_id, model_id и country_id уже существует в базе данных.',
        ];
    }
}
