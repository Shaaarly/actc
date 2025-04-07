<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'price'             => 'required|min:2|max:10',
            'available'         => 'required|min:1|max:1',
            'ocupied'           => 'required|min:1|max:1',
            'description'       => 'required|min:2|max:100',
            'area'              => 'required|min:1|max:5',
            'bathrooms'         => 'nullable|min:1|max:2',
            'rooms'             => 'nullable|min:1|max:2',
            'remote'            => 'required|min:1|max:1',
            'keys'              => 'required|min:1|max:1',
            'letter'            => 'nullable|min:1|max:1',
            'number'            => 'nullable|min:1|max:4',
            'property_type_id'  => 'nullable|min:1|max:2',
            'country'           => 'required|min:3|max:56',
            'province'          => 'required|min:3|max:44',
            'city'              => 'required|min:3|max:58',
            'postal_code'       => 'required|min:3|max:10',
            'street_name'       => 'required|min:3|max:52',
            'entrance_number'   => 'required|min:1|max:4',
            'block'             => 'nullable|min:1|max:1', 
            'apartment_number'  => 'required|min:1|max:4',
            'floor'             => 'required|min:1|max:2',
            'passageway'        => 'nullable|min:3|max:60',
            'owners'            => ['nullable', 'array'],
            'owners.*'          => ['nullable', 'integer', 'exists:users,id'],
        ];
    }

    public function messages()
    {
        return [
            'price.required'            => 'El precio es obligatorio.',
            'price.min'                 => 'El precio debe tener al menos 2 caracteres.',
            'price.max'                 => 'El precio no debe exceder 10 caracteres.',

            'available.required'        => 'El estado de disponibilidad es obligatorio.',
            'available.min'             => 'El estado de disponibilidad debe tener 1 caracter.',
            'available.max'             => 'El estado de disponibilidad debe tener 1 caracter.',

            'ocupied.required'          => 'El estado de ocupación es obligatorio.',
            'ocupied.min'               => 'El estado de ocupación debe tener 1 caracter.',
            'ocupied.max'               => 'El estado de ocupación debe tener 1 caracter.',

            'description.required'      => 'La descripción es obligatoria.',
            'description.min'           => 'La descripción debe tener al menos 2 caracteres.',
            'description.max'           => 'La descripción no debe exceder 100 caracteres.',

            'area.required'             => 'El área es obligatoria.',
            'area.min'                  => 'El área debe tener al menos 1 caracter.',
            'area.max'                  => 'El área no debe exceder 5 caracteres.',

            'bathrooms.min'             => 'El número de baños debe tener al menos 1 dígito.',
            'bathrooms.max'             => 'El número de baños no debe exceder 2 dígitos.',

            'rooms.min'                 => 'El número de habitaciones debe tener al menos 1 dígito.',
            'rooms.max'                 => 'El número de habitaciones no debe exceder 2 dígitos.',

            'remote.required'           => 'El campo remoto es obligatorio.',
            'remote.min'                => 'El campo remoto debe tener 1 caracter.',
            'remote.max'                => 'El campo remoto debe tener 1 caracter.',

            'keys.required'             => 'El número de llaves es obligatorio.',
            'keys.min'                  => 'El número de llaves debe tener 1 dígito.',
            'keys.max'                  => 'El número de llaves debe tener 1 dígito.',

            'letter.min'                => 'La letra debe tener al menos 1 caracter.',
            'letter.max'                => 'La letra no debe exceder 1 caracter.',

            'number.min'                => 'El número debe tener al menos 1 dígito.',
            'number.max'                => 'El número no debe exceder 4 dígitos.',

            'property_type_id.min'      => 'El tipo de propiedad debe tener al menos 1 caracter.',
            'property_type_id.max'      => 'El tipo de propiedad no debe exceder 2 caracteres.',

            'country.required'          => 'El nombre del país es obligatorio.',
            'country.min'               => 'El nombre del país debe tener al menos 3 caracteres.',
            'country.max'               => 'El nombre del país no debe exceder 56 caracteres.',

            'province.required'         => 'El nombre de la provincia es obligatorio.',
            'province.min'              => 'El nombre de la provincia debe tener al menos 3 caracteres.',
            'province.max'              => 'El nombre de la provincia no debe exceder 44 caracteres.',

            'city.required'             => 'El nombre de la ciudad es obligatorio.',
            'city.min'                  => 'El nombre de la ciudad debe tener al menos 3 caracteres.',
            'city.max'                  => 'El nombre de la ciudad no debe exceder 58 caracteres.',

            'postal_code.required'      => 'El código postal es obligatorio.',
            'postal_code.min'           => 'El código postal debe tener al menos 3 dígitos.',
            'postal_code.max'           => 'El código postal no debe exceder 10 dígitos.',

            'street_name.required'      => 'El nombre de la calle es obligatorio.',
            'street_name.min'           => 'El nombre de la calle debe tener al menos 3 caracteres.',
            'street_name.max'           => 'El nombre de la calle no debe exceder 52 caracteres.',

            'entrance_number.required'  => 'El número de entrada es obligatorio.',
            'entrance_number.min'       => 'El número de entrada debe tener al menos 1 dígito.',
            'entrance_number.max'       => 'El número de entrada no debe exceder 4 dígitos.',

            'block.min'                 => 'El bloque debe tener al menos 1 caracter.',
            'block.max'                 => 'Sólo se puede asignar una letra al bloque.',

            'apartment_number.required' => 'El número de apartamento es obligatorio.',
            'apartment_number.min'      => 'El número de apartamento debe tener al menos 1 dígito.',
            'apartment_number.max'      => 'El número de apartamento no debe exceder 4 dígitos.',

            'floor.required'            => 'El piso es obligatorio.',
            'floor.min'                 => 'El piso debe tener al menos 1 dígito.',
            'floor.max'                 => 'El piso no debe exceder 2 dígitos.',

            'passageway.min'            => 'El nombre del pasaje debe tener al menos 3 caracteres.',
            'passageway.max'            => 'El nombre del pasaje no debe exceder 60 caracteres.',

            'owners.array'              => 'Los propietarios deben ser enviados como un arreglo.',
            'owners.*.integer'          => 'Cada propietario debe ser un ID numérico válido.',
            'owners.*.exists'           => 'Cada propietario debe existir en la base de datos.',
        ];
    }

}
