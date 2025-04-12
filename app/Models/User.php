<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'nama_orang_tua',
        'no_hp_orang_tua',
        'jenjang',
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

    public function isProfileComplete()
    {
        // Tentukan field wajib berdasarkan jenjang
        $requiredFields = ['name', 'email', 'jenjang', 'kk_path', 'akta_path', 'pasfoto_path'];

        if ($this->jenjang == 'smp') {
            $requiredFields[] = 'ijazah_sd_path';
        } elseif ($this->jenjang == 'sma') {
            $requiredFields[] = 'ijazah_smp_path';
        } elseif ($this->jenjang == 'kuliah') {
            $requiredFields[] = 'ijazah_sma_path';
        }

        if ($this->jenjang !== 'kuliah') {
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
}
