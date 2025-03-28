<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'notification_type_id',
        'payment_id'
    ];

    public function users() {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function type() {
        return $this->belongsTo(NotificationType::class);
    }
}
