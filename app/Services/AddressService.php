<?php


namespace App\Services;
use App\Models\Address;

class AddressService {

    public function saveAddress($object, $data) {
        if ($object->address) {
            $object->address->update([
                'country'          => $data['country'],
                'province'         => $data['province'],
                'city'             => $data['city'],
                'postal_code'      => $data['postal_code'],
                'street_name'      => $data['street_name'],
                'passageway'       => $data['passageway'] ?? null,
                'building_number'  => $data['building_number'],
                'floor'            => $data['floor'] ?? null,
                'block'            => $data['block'] ?? null,
                'number'           => $data['number'] ?? null,
            ]);
        } else {
            $object->address()->create([
                'addressable_type' => 'user',
                'addressable_id'   => $object->id,
                'country'          => $data['country'],
                'province'         => $data['province'],
                'city'             => $data['city'],
                'postal_code'      => $data['postal_code'],
                'street_name'      => $data['street_name'],
                'passageway'       => $data['passageway'] ?? null,
                'building_number'  => $data['building_number'],
                'floor'            => $data['floor'] ?? null,
                'block'            => $data['block'] ?? null,
                'number'           => $data['number'] ?? null,
            ]);
        }
    }
}