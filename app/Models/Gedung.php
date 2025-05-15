<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $fillable = ['school_location_id', 'nama_gedung'];

    public function schoolLocation()
    {
        return $this->belongsTo(SchoolLocation::class);
    }

    public function ruangs()
    {
        return $this->hasMany(Ruang::class);
    }
}
