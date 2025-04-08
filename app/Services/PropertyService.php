<?php

namespace App\Services;
use App\Models\User;
use App\Models\Address;

class PropertyService {


    public function __construct() {

    }

    public function createOrUpdateProperty($property, $data) {
        

        $property->price = $data['price'];
        $property->available = $data['available'];
        $property->ocupied = $data['ocupied'];
        $property->description = $data['description'];
        $property->area = $data['area'];
        $property->bathrooms = $data['bathrooms'];
        $property->rooms = $data['rooms'];
        $property->remote = $data['remote'];
        $property->keys = $data['keys'];
        $property->letter = $data['letter'];
        $property->number = $data['number'];
        $property->property_type_id = $data['property_type_id'];

        $property->save();

        // dd($property);

        $property->owners()->sync($data['owners']);


        if($property->address) {
            $property->address->update([
                'country'          => $data['country'],
                'province'         => $data['province'],
                'city'             => $data['city'],
                'postal_code'      => $data['postal_code'],
                'street_name'      => $data['street_name'],
                'passage'          => $data['passage'] ?? null,
                'entrance_number'  => $data['entrance_number'],
                'floor'            => $data['floor'],
                'block'            => $data['block'] ?? null,
                'apartment_number' => $data['apartment_number'],
            ]);
        } else {
            $property->address()->create([
                'addressable_type' => 'property',
                'addressable_id'   => $property->id,
                'country'          => $data['country'],
                'province'         => $data['province'],
                'city'             => $data['city'],
                'postal_code'      => $data['postal_code'],
                'street_name'      => $data['street_name'],
                'passage'          => $data['passage'] ?? null,
                'entrance_number'  => $data['entrance_number'],
                'floor'            => $data['floor'],
                'block'            => $data['block'] ?? null,
                'apartment_number' => $data['apartment_number'],
            ]);
        }

    }
}