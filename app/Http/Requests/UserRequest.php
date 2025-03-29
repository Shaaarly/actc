<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:2',
            'surname_first' => 'required|min:2',
            'surname_second' => 'min:2',
            'phone' => 'required|phone',
            'email' => 'required|email',
            'dni' => 'required|min:9',
            'country' => 'required|min:3',
            'province' => 'required|min:3',
            'postal_code' => 'required|min:3',
            'street_name' => 'required|min:3',
            'entrance_number' => 'required|min:3',
            'block' => 'min:1|max:1',
            'apartment_number' => 'required|min:3'
        ];
    }
}
