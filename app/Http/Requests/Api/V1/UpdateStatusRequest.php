<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStatusRequest extends FormRequest
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
            'status_name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                Rule::unique('statuses', 'status_name')->ignore($this->status->id),
            ],
            'status_description' => [
                'required',
                'string',
                'min:3',
            ],
            'status_number' => [
                'required',
                'integer',
                Rule::unique('statuses', 'status_number')->ignore($this->status->id),
            ],
        ];
    }
}
