<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
            'mark_model_country_id' => [
                'required',
                'integer',
                'exists:car_mark_model_countries,id',
            ],
            'type_id' => [
                'required',
                'integer',
                'exists:car_types,id',
            ],
            'color_id' => [
                'required',
                'integer',
                'exists:car_colors,id',
            ],
            'vin' => [
                'required',
                'string',
                'size:17',
                'regex:/^[A-HJ-NPQ-Z0-9]{17}$/',
                'unique:cars,vin',
            ],
            'pts' => [
                'required',
                'string',
                'size:10',
                'regex:/^\d{2}T[A-Z]{1}[0-9]{6}$/',
                'unique:cars,pts',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'block' => [
                'boolean',
            ],
            'date_at' => [
                'required',
                'date',
            ],
            'deleted_at' => [
                'nullable',
                'date',
            ],
        ];
    }
}
