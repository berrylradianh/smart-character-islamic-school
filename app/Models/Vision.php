<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    use HasFactory;

    protected $fillable = ['vision_text', 'mission_items', 'commitment_text', 'poster_image'];

    protected $casts = [
        'mission_items' => 'array',
    ];
}
