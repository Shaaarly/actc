<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_type'
    ];

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function leases() {
        return $this->hasMany(Lease::class);
    }

}
