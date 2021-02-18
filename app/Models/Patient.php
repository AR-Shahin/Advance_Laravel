<?php

namespace App\Models;

use App\Events\PatientEmailVerificationEvent;
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

    protected $dispatchesEvents =[
        'created' => PatientEmailVerificationEvent::class,
    ];
    #Mutators
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }
    public function setSlugAttribute($value){
        $this->attributes['slug'] = $value . '-' . uniqid();
    }
    #Accessors
    public function getNameAttribute($value){
        return ucwords($value);
    }

    #Scopes
    public function scopeIsVerified($query){
        return $query->where('is_verified',1);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

}
