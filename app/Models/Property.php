<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
        'available',
        'ocupied',
        'bathrooms',
        'rooms',
        'remote',
        'keys',
        'property_type_id'
    ];

    public function expenses() {
        return $this->hasMany(Expense::class);
    }

    public function type() {
        return $this->belongsTo(PropertyType::class);
    }

    public function owner() {
        return $this->belongsTo(User::class)->where('role_id', 2);
    }

    public function pictures() {
        return $this->morphToMany(Picture::class, 'picturable');
    }

    public function address() {
        return $this->morphOne(Address::class, 'addressable');
    }
}
