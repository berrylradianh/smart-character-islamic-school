<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'bukti_pembayaran_path',
        'ijazah_path',
        'status',
        'jadwal_tes',
        'school_location_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'jadwal_tes' => 'datetime',
    ];

    /**
     * Get the user associated with the registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the school location associated with the registration.
     */
    public function schoolLocation()
    {
        return $this->belongsTo(SchoolLocation::class);
    }
}
