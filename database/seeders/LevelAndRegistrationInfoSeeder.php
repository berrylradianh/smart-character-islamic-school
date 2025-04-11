<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\RegistrationInfo;
use Illuminate\Database\Seeder;

class LevelAndRegistrationInfoSeeder extends Seeder
{
    public function run()
    {
        $levels = [
            ['name' => 'Taman Kanak-Kanak (TK)', 'slug' => 'tk'],
            ['name' => 'Sekolah Dasar (SD)', 'slug' => 'sd'],
            ['name' => 'Sekolah Menengah Pertama (SMP)', 'slug' => 'smp'],
            ['name' => 'Sekolah Menengah Atas (SMA)', 'slug' => 'sma'],
        ];

        foreach ($levels as $levelData) {
            $level = Level::create($levelData);
            $levelMap[$levelData['slug']] = $level->id;
        }

        $registrationData = [
            'tk' => [
                'requirements' => [
                    'Membayar biaya pendaftaran Rp. 450.000,-',
                    'Mengisi formulir pendaftaran (online)',
                    'Upload kartu keluarga',
                    'Upload Kartu Keluarga (KK)',
                    'Upload scan/foto Akta Kelahiran',
                    'Upload pasfoto berukuran 3 x 4 berwarna',
                    'Upload scan/foto piagam kejuaraan (jika ada)',
                    'Usia minimal 4 tahun 10 bulan per 30 Juni 2025 (minimal kelahiran 31 Agustus 2019)',
                ],
                'stages' => [
                    'Pengambilan formulir di sekretariat sekolah',
                    'Pengisian dan pengembalian formulir',
                    'Observasi anak oleh guru',
                    'Pengumuman hasil seleksi',
                ],
                'fees' => [
                    'Formulir Pendaftaran: Rp 150.000',
                    'Uang Pangkal: Rp 3.000.000',
                    'SPP Bulanan: Rp 350.000',
                ],
            ],
            'sd' => [
                'requirements' => [
                    'Membayar biaya pendaftaran Rp. 450.000,-',
                    'Mengisi formulir pendaftaran (online)',
                    'Upload kartu keluarga',
                    'Upload Kartu Keluarga (KK)',
                    'Upload scan/foto Akta Kelahiran',
                    'Upload pasfoto berukuran 3 x 4 berwarna',
                    'Upload scan/foto piagam kejuaraan (jika ada)',
                    'Usia minimal 5 tahun 10 bulan per 30 Juni 2025 (minimal kelahiran 31 Agustus 2019)',
                ],
                'stages' => [
                    'Pendaftaran online/offline',
                    'Tes kemampuan dasar',
                    'Wawancara orang tua',
                    'Pengumuman hasil',
                ],
                'fees' => [
                    'Formulir Pendaftaran: Rp 200.000',
                    'Uang Pangkal: Rp 5.000.000',
                    'SPP Bulanan: Rp 500.000',
                ],
            ],
            'smp' => [
                'requirements' => [
                    'Fotokopi Ijazah SD (legalisir, 2 lembar)',
                    'Fotokopi Akte Kelahiran (2 lembar)',
                    'Fotokopi Kartu Keluarga (2 lembar)',
                    'Pas foto 3x4 (2 lembar)',
                ],
                'stages' => [
                    'Pendaftaran online/offline',
                    'Tes tulis (Matematika & Bahasa)',
                    'Wawancara siswa dan orang tua',
                    'Pengumuman hasil',
                ],
                'fees' => [
                    'Formulir Pendaftaran: Rp 250.000',
                    'Uang Pangkal: Rp 7.000.000',
                    'SPP Bulanan: Rp 700.000',
                ],
            ],
            'sma' => [
                'requirements' => [
                    'Fotokopi Ijazah SMP (legalisir, 2 lembar)',
                    'Fotokopi Akte Kelahiran (2 lembar)',
                    'Fotokopi Kartu Keluarga (2 lembar)',
                    'Pas foto 3x4 (2 lembar)',
                ],
                'stages' => [
                    'Pendaftaran online/offline',
                    'Tes tulis (IPA/IPS, Matematika, Bahasa)',
                    'Wawancara siswa',
                    'Pengumuman hasil',
                ],
                'fees' => [
                    'Formulir Pendaftaran: Rp 300.000',
                    'Uang Pangkal: Rp 10.000.000',
                    'SPP Bulanan: Rp 900.000',
                ],
            ],
        ];

        foreach ($registrationData as $slug => $info) {
            if (isset($levelMap[$slug])) {
                RegistrationInfo::create([
                    'level_id' => $levelMap[$slug],
                    'requirements' => $info['requirements'],
                    'stages' => $info['stages'],
                    'fees' => $info['fees'],
                ]);
            }
        }
    }
}
