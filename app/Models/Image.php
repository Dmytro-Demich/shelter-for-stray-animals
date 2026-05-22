<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{

    use HasFactory;

    protected $fillable = [
        'animal_id',
        'image'
    ];
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}


