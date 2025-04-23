<?php

namespace App\Services;
use App\Models\User;
use App\Models\Name;
use App\Models\Address;

use App\Services\AddressService;

class UserService {


    public function __construct(
        private AddressService $address_service
    ) {

    }


    public function syncPlates($user, array $plates){
        $user->plates()->delete();

        $filtered = array_filter($plates, fn($p) => trim($p) !== '');
    
        foreach ($filtered as $plateText) {
            $user->plates()->create(['plate' => $plateText]);
        }
    } 

    public function owners() {
        return User::where('role_id', 2)->get();
    }

    public function createOrUpdateUser($user, $data) {
        $user->dni   = $data['dni'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->confirmed = 1;

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

       $this->address_service->saveAddress($user, $data);
    }
}