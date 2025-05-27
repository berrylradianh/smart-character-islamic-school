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
        'level_id',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'pasfoto_path',
        'nama_panggilan',
        'nomor_induk_asal',
        'nisn',
        'tempat_lahir',
        'jenis_kelamin',
        'agama',
        'anak_ke',
        'status_anak',
        'diterima_kelas',
        'diterima_tanggal',
        'ra_tk_asal',
        'alamat_ra_tk',
        'sd_mi_asal',
        'alamat_sd_mi',
        'nama_ayah',
        'nama_ibu',
        'alamat_ayah',
        'alamat_ibu',
        'telepon_ortu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'pendidikan_ayah',
        'pendidikan_ibu',
        'penghasilan_ayah',
        'penghasilan_ibu',
        'nama_ayah_wali',
        'nama_ibu_wali',
        'alamat_ayah_wali',
        'alamat_ibu_wali',
        'telepon_wali',
        'pekerjaan_ayah_wali',
        'pekerjaan_ibu_wali',
        'pendidikan_ayah_wali',
        'pendidikan_ibu_wali',
        'penghasilan_ayah_wali',
        'penghasilan_ibu_wali',
        'asal_smp_mts',
        'asal_sma_smk'
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
            'tanggal_lahir' => 'date',
            'diterima_tanggal' => 'date',
            'penghasilan_ayah' => 'decimal:2',
            'penghasilan_ibu' => 'decimal:2',
            'penghasilan_ayah_wali' => 'decimal:2',
            'penghasilan_ibu_wali' => 'decimal:2',
        ];
    }

    /**
     * Check if the user's profile is complete.
     */
    public function isProfileComplete()
    {
        $requiredFields = ['name', 'email', 'level_id', 'tanggal_lahir', 'no_hp', 'alamat'];

        $levelSlug = $this->level ? $this->level->slug : null;

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
