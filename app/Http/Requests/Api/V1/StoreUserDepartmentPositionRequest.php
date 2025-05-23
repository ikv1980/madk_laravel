<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserDepartmentPositionRequest extends FormRequest
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
            'department_id' => [
                'required',
                'integer',
                'exists:user_departments,id',
                Rule::unique('user_department_positions')
                    ->where(function ($query) {
                        return $query
                            ->where('position_id', $this->position_id);
                    }),
            ],
            'position_id' => [
                'required',
                'integer',
                'exists:user_positions,id',
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
