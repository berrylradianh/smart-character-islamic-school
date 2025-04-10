<?php

namespace Database\Seeders;

use App\Models\Faqs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $faqs = [
        [
            'question' => 'Kapan pendaftaran siswa baru dibuka?',
            'answer' => 'Pendaftaran siswa baru untuk tahun ajaran 2025/2026 dibuka mulai tanggal 1 Mei 2025 hingga 30 Juni 2025, atau sampai kuota terpenuhi.',
            'order_number' => 1,
            'category_color' => 'success'
        ],
        [
            'question' => 'Apa saja persyaratan pendaftaran untuk TK?',
            'answer' => 'Untuk TK, diperlukan: 1) Akte kelahiran, 2) Kartu Keluarga, 3) Usia minimal 4 tahun per 1 Juli 2025, 4) Pas foto 3x4 (2 lembar), dan 5) Formulir pendaftaran yang telah diisi.',
            'order_number' => 2,
            'category_color' => 'primary'
        ],
        [
            'question' => 'Berapa biaya pendaftaran dan uang pangkal?',
            'answer' => 'Biaya pendaftaran Rp200.000. Uang pangkal bervariasi: TK Rp2.000.000, SD Rp3.000.000, SMP Rp4.000.000, SMA Rp5.000.000 (dapat dicicil sesuai ketentuan sekolah).',
            'order_number' => 3,
            'category_color' => 'warning'
        ],
        [
            'question' => 'Apakah ada tes masuk untuk SD?',
            'answer' => 'Ya, untuk SD ada tes sederhana berupa kemampuan dasar membaca, menulis, dan berhitung, serta wawancara singkat dengan orang tua.',
            'order_number' => 4,
            'category_color' => 'danger'
        ],
        [
            'question' => 'Dokumen apa saja yang dibutuhkan untuk pendaftaran SMP?',
            'answer' => 'Dokumen yang diperlukan: 1) Ijazah SD (atau SKL), 2) Akte kelahiran, 3) Kartu Keluarga, 4) Pas foto 3x4 (2 lembar), 5) Nilai raport semester 5-6 SD.',
            'order_number' => 5,
            'category_color' => 'info'
        ],
        [
            'question' => 'Apakah ada jalur khusus untuk SMA?',
            'answer' => 'Ya, kami menyediakan jalur prestasi akademik/non-akademik dan jalur reguler. Jalur prestasi diberikan bagi siswa dengan nilai raport tinggi atau prestasi olahraga/seni.',
            'order_number' => 6,
            'category_color' => 'dark'
        ],
        [
            'question' => 'Bagaimana cara mendaftar secara online?',
            'answer' => 'Kunjungi website resmi kami di www.sekolahscis.sch.id, klik menu PPDB, isi formulir online, unggah dokumen yang diperlukan, dan lakukan pembayaran melalui transfer bank.',
            'order_number' => 7,
            'category_color' => 'success'
        ],
        [
            'question' => 'Apakah ada beasiswa untuk siswa berprestasi?',
            'answer' => 'Ya, kami menyediakan beasiswa potongan uang pangkal hingga 50% untuk siswa berprestasi akademik atau non-akademik dengan syarat dan ketentuan berlaku.',
            'order_number' => 8,
            'category_color' => 'primary'
        ],
        [
            'question' => 'Kapan pengumuman hasil seleksi diumumkan?',
            'answer' => 'Pengumuman hasil seleksi akan diumumkan pada tanggal 10 Juli 2025 melalui website resmi dan email yang terdaftar.',
            'order_number' => 9,
            'category_color' => 'warning'
        ],
        [
            'question' => 'Apakah seragam disediakan oleh sekolah?',
            'answer' => 'Ya, seragam akan disediakan oleh sekolah dan dapat diambil setelah proses daftar ulang selesai. Biaya seragam sudah termasuk dalam uang pangkal.',
            'order_number' => 10,
            'category_color' => 'danger'
        ],
    ];

    foreach ($faqs as $faq) {
        Faqs::create($faq);
    }
}
}
