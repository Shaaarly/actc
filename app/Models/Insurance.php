<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'name',
        'price',
        'owner',
        'property_id',
        'description',
        'insurance_type_id'
    ];

    public function property() {
        return $this->belongsTo(Property::class);
    }

    public function type() {
        return $this->belongsTo(InsuranceType::class);
    }
}
