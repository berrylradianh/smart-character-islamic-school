<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $fillable = ['gedung_id', 'nama_ruang'];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }
}
