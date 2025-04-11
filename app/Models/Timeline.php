<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'title',
        'description',
        'date_range',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
