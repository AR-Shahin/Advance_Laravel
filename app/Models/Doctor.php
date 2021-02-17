<?php

namespace App\Models;

use App\Events\DoctorCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use function is_null;
use function json_encode;
use function uniqid;

class Doctor extends Authenticatable
{
    use HasFactory,Notifiable;

    //protected $fillable =['name','email','password','id'];
    protected $guarded = [];
    protected $with;
    public function __construct(array $attributes = [])
    {
        //parent::__construct($attributes);
        $this->with = ['country','designation','experiences','certificates','feedbacks'];
    }

    protected $casts = [
        'education' => 'array'
    ];
    protected $dispatchesEvents =[
        'created' => DoctorCreatedEvent::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }
    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value,'-').'-'.uniqid();
    }
    public function scopeIsActive($query){
        return $query->where('is_active',1);
    }
    public function scopeIsVerified($query){
        return $query->where('verified',1);
    }

    //muteors
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
    public function designation(){
        return $this->belongsTo(Designations::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function feedbacks(){
        return $this->hasMany(Feedback::class,'doctor_id','id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }




}
