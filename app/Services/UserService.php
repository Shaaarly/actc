<?php

namespace App\Services;
use App\Models\User;
use App\Models\Name;
use App\Models\Address;

class UserService {


    public function __construct() {

    }


    public function syncPlates($user, array $plates){
        $user->plates()->delete();

        $filtered = array_filter($plates, fn($p) => trim($p) !== '');
    
        foreach ($filtered as $plateText) {
            $user->plates()->create(['plate' => $plateText]);
        }
    } 

    public function createOrUpdateUser($user, $data) {
        $user->dni   = $data['dni'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];

        if(!isset($user->password)) {
            $user->password = $data['password'];
        }
        
        $user->description = $data['description'];

        if(!isset($user->role_id)) {
            $user->role_id = 1;
        }

        if($user->name) {
            $user->name->update([
                'name'           => $data['name'],
                'surname_first'  => $data['surname_first'],
                'surname_second' => $data['surname_second'] ?? null,
            ]);
        } else {
            $name = Name::create([
                'name'           => $data['name'],
                'surname_first'  => $data['surname_first'],
                'surname_second' => $data['surname_second'] ?? null,
            ]);
            $user->name_id = $name->id;
        }

        if (!$user->exists) {
            $user->save();
        }

        if ($user->address) {
            $user->address->update([
                'country'          => $data['country'],
                'province'         => $data['province'],
                'city'             => $data['city'],
                'postal_code'      => $data['postal_code'],
                'street_name'      => $data['street_name'],
                'passageway'       => $data['passageway'] ?? null,
                'entrance_number'  => $data['entrance_number'],
                'floor'            => $data['floor'] ?? null,
                'block'            => $data['block'] ?? null,
                'apartment_number' => $data['apartment_number'] ?? null,
            ]);
        } else {
            $user->address()->create([
                'addressable_type' => 'user',
                'addressable_id'   => $user->id,
                'country'          => $data['country'],
                'province'         => $data['province'],
                'city'             => $data['city'],
                'postal_code'      => $data['postal_code'],
                'street_name'      => $data['street_name'],
                'passageway'       => $data['passageway'] ?? null,
                'entrance_number'  => $data['entrance_number'],
                'floor'            => $data['floor'] ?? null,
                'block'            => $data['block'] ?? null,
                'apartment_number' => $data['apartment_number'] ?? null,
            ]);
        }
    }
}