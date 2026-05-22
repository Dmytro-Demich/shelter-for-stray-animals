<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'animal_id',
        'name',
        'phone',
        'email',
        'message',
        'status'
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
