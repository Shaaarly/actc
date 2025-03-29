<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'returned',
        'description',
        'amount',
        'leases_id'
    ];

    public function lease() {
        return $this->belongsTo(Lease::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
