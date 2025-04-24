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

    public function getOwners() {
        return User::where('role_id', 2)->get();
    }

    public function getClients() {
        return User::where('role_id', 1)->get();
    }

    public function getConfirmedClients() {
        return User::where('role_id', 1)
                    ->where('confirmed', 1)            
                    ->get();
    }

    public function createOrUpdateUser($user, $data) {
        // Campos directos del usuario
        if (array_key_exists('dni', $data)) {
            $user->dni = $data['dni'];
        }
    
        if (array_key_exists('phone', $data)) {
            $user->phone = $data['phone'];
        }
    
        if (array_key_exists('email', $data)) {
            $user->email = $data['email'];
        }
    
        if (array_key_exists('password', $data)) {
            $user->password = bcrypt($data['password']); // Por si viene plano
        }
    
        if (array_key_exists('description', $data)) {
            $user->description = $data['description'];
        }
    
        // Solo para nuevos usuarios
        if (!isset($user->role_id)) {
            $user->role_id = 1;
        }
    
        // Confirmado por defecto si se edita desde dentro
        $user->confirmed = 1;
    
        // Manejo del modelo Name
        if (
            array_key_exists('name', $data) ||
            array_key_exists('surname_first', $data) ||
            array_key_exists('surname_second', $data)
        ) {
            if ($user->name) {
                $user->name->update([
                    'name'           => $data['name'] ?? $user->name->name,
                    'surname_first'  => $data['surname_first'] ?? $user->name->surname_first,
                    'surname_second' => $data['surname_second'] ?? $user->name->surname_second,
                ]);
            } else {
                $name = Name::create([
                    'name'           => $data['name'] ?? '',
                    'surname_first'  => $data['surname_first'] ?? '',
                    'surname_second' => $data['surname_second'] ?? null,
                ]);
                $user->name_id = $name->id;
            }
        }
    
        // Guardar usuario antes de relaciones
        $user->save();
    
        // Guardar dirección solo si hay campos de dirección
        if (array_intersect(array_keys($data), [
            'country', 'province', 'city', 'postal_code',
            'street_name', 'building_number', 'block', 'number', 'floor', 'passageway'
        ])) {
            $this->address_service->saveAddress($user, $data);
        }
    }
    
}