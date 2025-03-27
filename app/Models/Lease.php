<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'property_id',
        'client_id',
        'owner_id',
        'keys_returned',
        'remote_returned',
        'start_date',
        'ending_date'
    ];

    public function property() {
        return $this->belongsTo(Property::class);
    }

    public function client() {
        return $this->belongsTo(User::class)->where('role_id', 1);
    }

    public function owner() {
        return $this->belongsTo(User::class)->where('role_id', 2);
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
}
