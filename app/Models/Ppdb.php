<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'program_unggulan',
        'jenjang_pendidikan',
        'jadwal_pendaftaran',
        'contact_info',
        'image',
        'registrant_counts', // Add registrant_counts to fillable
        'rincian_biaya',
        'jadwal_ppdb',
        'dokumen_diperlukan',
    ];

    protected $casts = [
        'program_unggulan' => 'array',
        'rincian_biaya' => 'array',
        'jadwal_ppdb' => 'array',
        'dokumen_diperlukan' => 'array',
        'registrant_counts' => 'array', // Cast registrant_counts as array
    ];
}
