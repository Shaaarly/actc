<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
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
        'date',
        'user_id',
        'payment_id'
    ];

    public function bill() {
        return $this->hasOne(Bill::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
