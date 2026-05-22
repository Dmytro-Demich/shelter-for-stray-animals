<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Application;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animals';

    protected $fillable = [
        'name',
        'type',
        'breed',
        'gender',
        'age',
        'status',
        'description',
        'image'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
