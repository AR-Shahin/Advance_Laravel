<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Prune extends Model
{
    use HasFactory, Prunable;
    protected $guarded = [];

    public function prunable()
    {
        return static::where('view', '>=', 50);
    }
    protected function pruning()
    {
        echo $this->title . PHP_EOL;
    }
}
