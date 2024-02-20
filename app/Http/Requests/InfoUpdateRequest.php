<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoUpdateRequest extends FormRequest
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
            'phone' => 'sometimes|string',
            'email' => 'sometimes|string',
            'vk' => 'sometimes|string',
            'telegram' => 'sometimes|string',
            'whatsapp' => 'sometimes|string',
            'viber' => 'sometimes|string',
            'instagram' => 'sometimes|string',
        ];
    }
}
