<?php

namespace Database\Seeders;

use App\Models\Gedung;
use App\Models\Ruang;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all buildings
        $gedungs = Gedung::all();

        if ($gedungs->isEmpty()) {
            $this->command->info('No gedungs found. Please seed Gedung first.');
            return;
        }

        $ruangs = [
            ['nama_ruang' => 'Ruang 101'],
            ['nama_ruang' => 'Ruang 102'],
            ['nama_ruang' => 'Ruang 201'],
            ['nama_ruang' => 'Ruang 202'],
            ['nama_ruang' => 'Ruang Seminar'],
        ];

        foreach ($gedungs as $gedung) {
            foreach ($ruangs as $ruang) {
                Ruang::create([
                    'gedung_id' => $gedung->id,
                    'nama_ruang' => $ruang['nama_ruang'] . ' - ' . $gedung->nama_gedung,
                ]);
            }
        }
    }
}
