<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'biaya',
    ];

    public function registrationInfos()
    {
        return $this->hasMany(RegistrationInfo::class);
    }

    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }
}
