<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'title',
        'release_date',
        'genre',
        'director',
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}