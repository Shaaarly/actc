<?php

namespace App\Services;
use App\Models\User;
use App\Models\Address;
use App\Models\PropertyType;

use App\Services\AddressService;

class PropertyService {


    public function __construct(
        private AddressService $address_service
    ) {

    }

    public function getPropertyTypes()
    {
        return PropertyType::all();
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
        $property->property_type_id = $data['property_type_id'];

        $property->save();

        // dd($property);

        $property->owners()->sync($data['owners']);


        $this->address_service->saveAddress($property, $data);

    }
}