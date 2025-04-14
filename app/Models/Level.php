<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'biaya',
    ];

    /**
     * Get the registration infos associated with the level.
     */
    public function registrationInfos()
    {
        return $this->hasMany(RegistrationInfo::class);
    }

    /**
     * Get the timelines associated with the level.
     */
    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }

    /**
     * Get the users associated with the level.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
