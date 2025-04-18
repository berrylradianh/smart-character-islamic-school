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
