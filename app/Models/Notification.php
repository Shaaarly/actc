<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'message',
        'payment_id'
    ];

    public function users() {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
