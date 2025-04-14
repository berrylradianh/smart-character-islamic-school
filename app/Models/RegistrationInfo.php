<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'requirements',
        'stages',
        'fees',
    ];

    protected $casts = [
        'requirements' => 'array',
        'stages' => 'array',
        'fees' => 'array',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
