<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use function md5;
use function ucwords;
use function uniqid;

class Patient extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $guarded = [];

    protected $casts = [
        'verified_time' => 'datetime:Y-m-d h:i:s'
    ];

    #Mutators
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }
    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value . '-' . uniqid();
    }
    public function setTokenAttribute($value){
        $this->attributes['token'] = md5($value) . uniqid();
    }
    #Accessors
    public function getNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    #Scopes
    public function scopeIsVerified($query){
        return $query->where('is_verified',1);
    }

}
