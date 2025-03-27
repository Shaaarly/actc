<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'picturable_type',
        'picturable_id',
        'source'
    ];

    public function picturable() {
        return $this->morphTo();
    }

    public function users() {
        return $this->morphedByMany(User::class, 'picturable');
    }

    public function properties() {
        return $this->morphedByMany(Property::class, 'picturable');
    }
}
