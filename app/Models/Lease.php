<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lease extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'property_id',
        'client_id',
        'owner_id',
        'payment_type_id',
        'keys_returned',
        'remote_returned',
        'start_lease',
        'ending_lease',
        'value'
    ];

    protected $casts = [
        'start_lease' => 'date',
        'ending_lease' => 'date'
    ];

    public function property() {
        return $this->belongsTo(Property::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function deposit() {
        return $this->hasOne(Deposit::class);
    }

    public function contract() {
        return $this->hasOne(Contract::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function paymentType() {
        return $this->belongsTo(PaymentType::class);
    }
}
