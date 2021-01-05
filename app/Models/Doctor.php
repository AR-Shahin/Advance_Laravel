<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $fillable =['name','email','password'];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function scopeIsActive($query){
        return $query->where('is_active',1);
    }
}
