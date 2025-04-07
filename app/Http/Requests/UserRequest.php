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
            'name'             => 'required|min:2|max:60',
            'surname_first'    => 'required|min:2|max:30',
            'surname_second'   => 'nullable|min:2|max:30',
            'phone'            => 'required|digits_between:9,10',
            'email'            => 'required|email',
            'dni'              => 'required|min:9|max:10',
            'description'      => 'required|min:2|max:255',
            'country'          => 'required|min:3|max:56',
            'province'         => 'required|min:3|max:44',
            'city'             => 'required|min:3|max:58',
            'postal_code'      => 'required|min:3|max:10',
            'street_name'      => 'required|min:3|max:52',
            'entrance_number'  => 'required|min:1|max:4',
            'block'            => 'nullable|min:1|max:1', 
            'apartment_number' => 'required|min:1|max:4',
            'floor'            => 'required|min:1|max:2',
            'passageway'       => 'nullable|min:3|max:60',
            'plates'           => ['nullable', 'array'],
            'plates.*'         => ['nullable', 'string', 'max:255'],
            'password'         => ['string', 'max:32']
        ];
    }

    public function messages(){

        return [
            'name' => 'El nombre debe tener al menos 2 carácteres y máximo 60.',
            'surname_first' => 'El primer apellido debe tener al menos 2 carácteres y máximo 30.',
            'surname_second' => 'El primer apellido debe tener al menos 2 carácteres y máximo 30.',
            'phone' => 'El teléfono debe tener un formato válido.',
            'email' => 'El correo debe tener un formato válido.',
            'dni' => 'El DNI debe tener un formato válido.',
            'country' => 'El nombre del país debe tener al menos 3 carácteres y máximo 56.',
            'province' => 'El nombre de la provincia debe tener al menos 3 carácteres y máximo 44.',
            'city' => 'El nombre debe tener al menos 3 carácteres y máximo 58.',
            'postal_code' => 'El código postal debe tener al menos 3 dígitos y máximo 10.',
            'street_name' => 'El nombre de la calle debe tener al menos 3 carácteres y máximo 52.',
            'entrance_number' => 'El número de la entrada debe tener al menos 1 dígito y máximo 4.',
            'block' => 'Sólo se puede asignar una letra al bloque.',
            'apartment_number' => 'El número de apartamento debe tener al menos 1 dígito y máximo 4.',
            'floor' => 'El número debe tener al menos 1 dígito y máximo 2.',
            'passageway' => 'El nombre del pasage debe tener al menos 3 carácteresto y máximo 60.',
            'plate' => 'Introduzca una matrícula válida.',
            'password' => 'Introduzca una contraseña válida.'
        ];
    }
}
