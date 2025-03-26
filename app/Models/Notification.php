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
        'message'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'notification_user', 'notification_id', 'user_id')
                    ->withTimestamps()
                    // ->withPivot('read_at', 'sent_at') // si tienes columnas extra en la pivote
                    ;
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
