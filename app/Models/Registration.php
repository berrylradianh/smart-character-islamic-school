<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenjang',
        'nama_anak',
        'nama_orang_tua',
        'no_hp_orang_tua',
        'tanggal_lahir',
        'kk_path',
        'akta_path',
        'pasfoto_path',
        'piagam_path',
        'bukti_pembayaran_path',
        'ijazah_path',
        'status',
        'jadwal_tes',
        'school_location_id'
    ];

    protected $casts = [
        'jadwal_tes' => 'datetime',
    ];

    public function schoolLocation()
    {
        return $this->belongsTo(SchoolLocation::class);
    }
}
