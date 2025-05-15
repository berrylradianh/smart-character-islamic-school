<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolLocation extends Model
{
    protected $fillable = ['nama_lokasi', 'alamat', 'kontak'];

    public function gedungs()
    {
        return $this->hasMany(Gedung::class);
    }
}
