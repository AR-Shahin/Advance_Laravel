<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use function is_null;
use function json_encode;

class Doctor extends Authenticatable
{
    use HasFactory,Notifiable;

    //protected $fillable =['name','email','password','id'];
    protected $guarded = [];
    protected $casts = [
        'education' => 'array'
    ];
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function scopeIsActive($query){
        return $query->where('is_active',1);
    }

    public function setEducationAttribute($values){
        $education = [];
        foreach ($values as $value){
            if(!is_null($value['key'])){
                $education[] = $value;
            }
        }
        $this->attributes['education'] = json_encode($education);
    }

    public function experiences(){
       return $this->hasMany(Experience::class, 'doctor_id','id');
    }

    public function certificates(){
       return $this->hasMany(Certificate::class, 'doctor_id');
    }
}
