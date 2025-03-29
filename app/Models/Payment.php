<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
        'description',
        'status',
        'payment_type_id'
    ];

    public function detail() {
        return $this->hasOne(Detail::class);
    }

    public function paymentTypes() {
        return $this->belongsTo(PaymentsType::class);
    }

    // public function clients() {
    //     return $this->belongsToMany(User::class)->where('role_id', 1);
    // }

    // public function properties() {
    //     return $this->belongsToMany(Property::class);
    // }

    public function lease() {
        return $this->belongsTo(Lease::class);
    }

    public function owner() {
        return $this->belongsTo(User::class)->where('role_id', 2);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }

    public function expense() {
        return $this->belongsTo(Expense::class);
    }

    public function deposit() {
        return $this->belongsTo(Deposit::class);
    }
}