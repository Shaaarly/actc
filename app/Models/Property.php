<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\FormatsAddressDisplay;

class Property extends Model
{
    use HasFactory, SoftDeletes, FormatsAddressDisplay;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
        'available',
        'ocupied',
        'description',
        'area',
        'bathrooms',
        'rooms',
        'remote',
        'keys',
        'letter',
        'property_type_id'
    ];

    public function expenses() {
        return $this->hasMany(Expense::class);
    }

    public function type() {
        return $this->belongsTo(PropertyType::class, 'property_type_id', 'id');
    }

    public function owners() {
        return $this->belongsToMany(
            User::class,
            'owner_property',
            'property_id',
            'owner_id'
        )->where('role_id', 2);
    }
    
    public function clients()
    {
        return $this->belongsToMany(User::class, 'leases', 'property_id', 'client_id')
                    ->withPivot('start_lease', 'end_lease');
    }

    public function pictures() {
        return $this->morphToMany(Picture::class, 'picturable');
    }

    public function address() {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function leases()
    {
        return $this->hasMany(Lease::class, 'property_id');
    }

    public function insurances() 
    {
        return $this->hasMany(Insurance::class, 'property_id');
    }

    // public function syncOwners(array $plates){
    //     $this->owners()->delete();

    //     $filtered = array_filter($owners, fn($p) => trim($p) !== '');
    
    //     foreach ($filtered as $plateText) {
    //         $this->owners()->create(['plate' => $plateText]);
    //     }
    // }


}
