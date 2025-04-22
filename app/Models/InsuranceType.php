<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'insurance_type'
    ];

    public function insurances() {
        return $this->hasMany(Insurance::class);
    }
}
