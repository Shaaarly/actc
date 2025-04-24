<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


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
        $userId = $this->user()?->id ?? auth()->id();

        return [
            'name'             => ['sometimes', 'required', 'min:2', 'max:60'],
            'surname_first'    => ['sometimes', 'required', 'min:2', 'max:30'],
            'surname_second'   => ['sometimes', 'nullable', 'min:2', 'max:30'],
            'phone'            => ['sometimes', 'required', 'digits_between:9,10'],
            'email'            => [
                'sometimes', 'required', 'email',
                Rule::unique('users', 'email')->ignore($userId)
            ],
            'dni'              => ['sometimes', 'required', 'min:9', 'max:10'],
            'description'      => ['sometimes', 'nullable', 'min:2', 'max:255'],

            'country'          => ['sometimes', 'required', 'min:3', 'max:56'],
            'province'         => ['sometimes', 'required', 'min:3', 'max:44'],
            'city'             => ['sometimes', 'required', 'min:3', 'max:58'],
            'postal_code'      => ['sometimes', 'required', 'min:3', 'max:10'],
            'street_name'      => ['sometimes', 'required', 'min:3', 'max:52'],
            'building_number'  => ['sometimes', 'required', 'min:1', 'max:4'],
            'block'            => ['sometimes', 'nullable', 'min:1', 'max:1'], 
            'number'           => ['sometimes', 'required', 'min:1', 'max:4'],
            'floor'            => ['sometimes', 'required', 'min:1', 'max:2'],
            'passageway'       => ['sometimes', 'nullable', 'min:3', 'max:60'],

            'plates'           => ['sometimes', 'nullable', 'array'],
            'plates.*'         => ['sometimes', 'nullable', 'string', 'max:255'],

            'password'         => ['sometimes', 'nullable', 'string', 'max:32'],
        ];
    }


    public function messages(){

        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'name.max' => 'El nombre no puede tener más de 60 caracteres.',
            
            'surname_first.required' => 'El primer apellido es obligatorio.',
            'surname_first.min' => 'El apellido debe tener al menos 2 caracteres.',
            'surname_first.max' => 'El apellido debe tener como máximo 30 caracteres.',

            'surname_second.min' => 'El apellido debe tener al menos 2 caracteres.',
            'surname_second.max' => 'El apellido debe tener como máximo 30 caracteres.',

            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits_between' => 'El número de teléfono debe tener entre 9 y 10 dígitos.',

            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Formato de correo no válido.',
            'email.unique' => 'Correo no válido.',

            'dni.required' => 'El DNI es obligatorio.',
            'dni.min' => 'el DNI debe tener mínimo 9 caracteres.',
            'dni.max' => 'El DNI debe tener máximo 10 caracteres.',

            'country.required' => 'El país es obligatorio.',
            'province.required' => 'La provincia es obligatoria.',
            'city.required' => 'La ciudad es obligatoria.',
            'postal_code.required' => 'El código postal es obligatorio.',
            'street_name.required' => 'La calle es obligatoria.',
            'building_number.required' => 'El número de entrada es obligatorio.',
            'number.required' => 'El número del apartamento es obligatorio.',
            'floor.required' => 'El piso es obligatorio.',

            'password.max' => 'La contraseña no debe superar los 32 caracteres.',
        ];
    }
}
