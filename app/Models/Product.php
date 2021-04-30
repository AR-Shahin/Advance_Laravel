<?php

namespace App\Models;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','name','text'];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    protected $dispatchesEvents = [
        'created' => PostCreated::class
    ];
}
