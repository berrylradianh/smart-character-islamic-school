<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'nama_orang_tua',
        'no_hp_orang_tua',
        'level_id',
        'kk_path',
        'akta_path',
        'pasfoto_path',
        'ijazah_sd_path',
        'ijazah_smp_path',
        'ijazah_sma_path',
        'piagam_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    /**
     * Check if the user's profile is complete.
     */
    public function isProfileComplete()
    {
        // Tentukan field wajib berdasarkan level_id
        $requiredFields = ['name', 'email', 'level_id', 'kk_path', 'akta_path', 'pasfoto_path'];

        // Ambil slug level untuk logika jenjang
        $levelSlug = $this->level ? $this->level->slug : null;

        if ($levelSlug == 'smp') {
            $requiredFields[] = 'ijazah_sd_path';
        } elseif ($levelSlug == 'sma') {
            $requiredFields[] = 'ijazah_smp_path';
        } elseif ($levelSlug == 'kuliah') {
            $requiredFields[] = 'ijazah_sma_path';
        }

        if ($levelSlug !== 'kuliah') {
            $requiredFields[] = 'nama_orang_tua';
            $requiredFields[] = 'no_hp_orang_tua';
        }

        foreach ($requiredFields as $field) {
            if (is_null($this->$field)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the registrations associated with the user.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get the level associated with the user.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
