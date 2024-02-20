<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'comment' => 'sometimes',
            'reciever' => 'sometimes',
            'delivery' => 'sometimes',
            'city' => 'required_if:delivery,=,ship',
            'address' => 'required_if:delivery,=,ship',
            'items' => 'required|array',
            'rules' => 'accepted',
        ];
    }
}
