<?php

namespace App\Traits;

trait FormatsAddressDisplay
{
    /**
     * Devuelve una cadena formateada con los datos visibles de la propiedad.
     */
    public function formatPropertyName(): string
    {
        $type = $this->type?->property_type ?? 'Propiedad';
        $street = $this->address?->street_name ?? 'Dirección desconocida';
        $address = $this->address ?? 'Desconocido';
        $identificador = '';
        $id = $address->number;
        
        switch($type) {
            case 'Local':
            case 'Vivienda':
            case 'Trastero':
                $identificador = 'puerta ' . $address->number;
                break;
        
            case 'Garage':
            
                $identificador = $address->number . $this->letter;
                break;
        }


        return "{$street}". $address->building_number . ', ' . ($identificador ? " {$identificador} " : '');
    }

    /**
     * Devuelve una dirección formateada completa (si se requiere).
     */
    public function formatFullAddress(): string
    {
        if (!$this->address) return 'Sin dirección';

        $address = $this->address->street_name;
        if ($this->address->passageway) {
            $address .= ', pasaje: ' . $this->address->passageway;
        }
        $address .= ' ' . $this->address->building_number;
        if ($this->address->block) {
            $address .= ', bloque: ' . $this->address->block;
        }
        $address .= ', piso: ' . $this->address->floor . ', puerta: ' . $this->address->number;

        return $address;
    }
}
