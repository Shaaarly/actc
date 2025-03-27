<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'addressable_type',
        'addressable_id',
        'postal_code',
        'street_name',
        'entrance_number',
        'apartment_number',
        'city',
        'country',
        'block',
        'floor'
    ];

    public function addressable() {
        return $this->morphTo();
    }    
}
