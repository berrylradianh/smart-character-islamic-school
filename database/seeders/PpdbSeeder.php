<?php

namespace Database\Seeders;

use App\Models\Ppdb;
use Illuminate\Database\Seeder;

class PpdbSeeder extends Seeder
{
    public function run()
    {
        Ppdb::create([
            'description' => '<strong>Smart Character Islamic School (SCIS)</strong> membuka <strong>Penerimaan Peserta Didik Baru (PPDB)</strong> untuk Tahun Ajaran 2025–2026! Kami berkomitmen mencetak generasi Qur\'ani yang cerdas, berkarakter, dan siap menghadapi tantangan zaman.',
            'program_unggulan' => [
                'Tahfizh Qur’an dan pembiasaan adab Islami',
                'Pendidikan karakter berbasis Al-Qur’an dan Hadits',
                'Bahasa Inggris dan Arab sejak dini',
                'Pembelajaran berbasis proyek dan teknologi',
                'Ekstrakurikuler Islami dan pengembangan minat bakat',
            ],
            'jenjang_pendidikan' => 'Taman Kanak-Kanak (TK), dan Sekolah Dasar (SD), Sekolah Menengah (SMP), dan Sekolah Menengah Atas (SMA)',
            'jadwal_pendaftaran' => '1 November 2024 – 30 Juni 2025',
            'contact_info' => 'WhatsApp: <a href="https://wa.me/62812XXXXXXX" target="_blank">0812-XXXX-XXXX</a>',
            'image' => 'ppdb_images/ppdb.png',
            'registrant_counts' => [
                'tk' => 35,
                'sd' => 70,
                'smp' => 40,
                'sma' => 20,
            ],
            'rincian_biaya' => [
                'Biaya Pendaftaran: Rp 500.000',
                'Uang Pangkal: Rp 5.000.000',
                'SPP Bulanan: Rp 1.000.000',
            ],
            'jadwal_ppdb' => [
                'Pendaftaran: 1 Januari 2025 - 30 Juni 2025',
                'Tes Seleksi: 1 Juli 2025 - 5 Juli 2025',
                'Pengumuman: 10 Juli 2025',
            ],
            'dokumen_diperlukan' => [
                'Fotokopi Akta Kelahiran',
                'Fotokopi Kartu Keluarga',
                'Pas Foto 3x4 (2 lembar)',
                'Surat Keterangan Sehat',
            ],
        ]);
    }
}
