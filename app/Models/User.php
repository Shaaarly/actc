<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dni',
        'email',
        'password',
        'phone',
        'name_id',
        'description',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function name() {
        return $this->belongsTo(Name::class);
    }
    
    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function plates() {
        return $this->hasMany(Plate::class);
    }

    public function notifications() {
        return $this->belongsToMany(Notification::class, 'notification_user', 'user_id', 'notification_id')
                    ->withTimestamps();
    }

    // public function payments() {
    //     return $this->hasMany(Payment::class);
    // }

    public function propertiesOwned() {
        return $this->belongsToMany(
            Property::class,
            'owner_property',
            'owner_id',
            'property_id'
        );
    }

    public function propertiesLeased() {
        return $this->hasManyThrough(
            Property::class,
            Lease::class,
            'client_id', 
            'id',        
            'id',       
            'property_id' 
        );
    }    

    public function leasesAsOwner() {
        return $this->hasMany(Lease::class, 'owner_id');
    }

    public function leasesAsClient() {
        return $this->hasMany(Lease::class, 'client_id');
    }

    public function details() {
        return $this->hasMany(Detail::class);
    }
    
    public function pictures() {
        return $this->morphToMany(Picture::class, 'picturable');
    }

    public function address() {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function insurances() {
        return $this->hasMany(Insurance::class, 'owner_id');
    }

    // public function lastBill(){
    //     return $this->hasManyThrough(Bill::class, Payment::class, 'owner_id', 'payment_id')
    //             ->latestOfMany();
    // } SERVICE!

}