<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposits extends Model
{
    use HasFactory;

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
}
