<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Timeline;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    public function run()
    {
        $levelMap = Level::pluck('id', 'slug')->toArray();

        $data = [
            'tk' => [
                ['date_range' => '1 - 15 Mei 2025', 'title' => 'Pendaftaran Online TK', 'description' => 'Orang tua mendaftarkan anak usia 4-6 tahun melalui website resmi sekolah.'],
                ['date_range' => '16 - 20 Mei 2025', 'title' => 'Pengumpulan Berkas', 'description' => 'Penyerahan akta kelahiran, KK, dan foto anak ke sekolah.'],
                ['date_range' => '25 - 27 Mei 2025', 'title' => 'Observasi Anak', 'description' => 'Observasi kemampuan motorik dan sosial anak oleh guru TK.'],
                ['date_range' => '30 Mei 2025', 'title' => 'Pengumuman Hasil', 'description' => 'Pengumuman siswa diterima diumumkan melalui website dan papan pengumuman.'],
                ['date_range' => '5 - 10 Juni 2025', 'title' => 'Daftar Ulang', 'description' => 'Pembayaran biaya masuk dan pengambilan seragam sekolah.'],
                ['date_range' => '1 Juli 2025', 'title' => 'Masuk Sekolah', 'description' => 'Hari pertama masuk sekolah untuk siswa TK.'],
            ],
            'sd' => [
                ['date_range' => '1 - 20 Juni 2025', 'title' => 'Pendaftaran Online SD', 'description' => 'Pendaftaran untuk anak usia 6-7 tahun melalui portal sekolah.'],
                ['date_range' => '21 - 25 Juni 2025', 'title' => 'Pengumpulan Berkas', 'description' => 'Penyerahan akta kelahiran, KK, dan rapor TK ke sekolah.'],
                ['date_range' => '28 - 30 Juni 2025', 'title' => 'Tes Masuk SD', 'description' => 'Tes membaca, menulis, dan berhitung untuk calon siswa.'],
                ['date_range' => '5 Juli 2025', 'title' => 'Pengumuman Hasil', 'description' => 'Pengumuman siswa diterima melalui website resmi.'],
                ['date_range' => '10 - 15 Juli 2025', 'title' => 'Daftar Ulang', 'description' => 'Pembayaran biaya masuk dan pengukuran seragam.'],
                ['date_range' => '20 Juli 2025', 'title' => 'Masuk Sekolah', 'description' => 'Hari pertama masuk sekolah untuk siswa SD.'],
            ],
            'smp' => [
                ['date_range' => '1 - 25 Juli 2025', 'title' => 'Pendaftaran Online SMP', 'description' => 'Pendaftaran untuk lulusan SD melalui website sekolah.'],
                ['date_range' => '26 - 30 Juli 2025', 'title' => 'Pengumpulan Berkas', 'description' => 'Penyerahan ijazah SD, SKHUN, dan rapor terakhir.'],
                ['date_range' => '2 - 5 Agustus 2025', 'title' => 'Ujian Masuk SMP', 'description' => 'Ujian tertulis: Matematika, IPA, dan Bahasa Indonesia.'],
                ['date_range' => '10 Agustus 2025', 'title' => 'Pengumuman Hasil', 'description' => 'Pengumuman siswa diterima di website dan sekolah.'],
                ['date_range' => '15 - 20 Agustus 2025', 'title' => 'Daftar Ulang', 'description' => 'Pembayaran biaya masuk dan pengambilan buku pelajaran.'],
                ['date_range' => '1 September 2025', 'title' => 'Masuk Sekolah', 'description' => 'Hari pertama masuk sekolah untuk siswa SMP.'],
            ],
            'sma' => [
                ['date_range' => '1 - 20 Agustus 2025', 'title' => 'Pendaftaran Online SMA', 'description' => 'Pendaftaran untuk lulusan SMP melalui portal resmi.'],
                ['date_range' => '21 - 25 Agustus 2025', 'title' => 'Pengumpulan Berkas', 'description' => 'Penyerahan ijazah SMP, SKHUN, dan rapor terakhir.'],
                ['date_range' => '28 - 31 Agustus 2025', 'title' => 'Tes Masuk SMA', 'description' => 'Tes akademik: Matematika, Bahasa Inggris, dan IPA/IPS sesuai jurusan.'],
                ['date_range' => '5 September 2025', 'title' => 'Pengumuman Hasil', 'description' => 'Pengumuman siswa diterima diumumkan secara online.'],
                ['date_range' => '10 - 15 September 2025', 'title' => 'Daftar Ulang', 'description' => 'Pembayaran biaya masuk dan orientasi siswa baru.'],
                ['date_range' => '20 September 2025', 'title' => 'Masuk Sekolah', 'description' => 'Hari pertama masuk sekolah untuk siswa SMA.'],
            ],
        ];

        foreach ($data as $slug => $timelines) {
            if (isset($levelMap[$slug])) {
                foreach ($timelines as $timeline) {
                    Timeline::create([
                        'level_id' => $levelMap[$slug],
                        'date_range' => $timeline['date_range'],
                        'title' => $timeline['title'],
                        'description' => $timeline['description'],
                    ]);
                }
            }
        }
    }
}
