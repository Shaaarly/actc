<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'addressable_type',
        'addressable_id',
        'postal_code',
        'province',
        'street_name',
        'passageway',
        'building_number',
        'number',
        'city',
        'country',
        'block',
        'floor'
    ];

    public function addressable() {
        return $this->morphTo();
    }    
}
