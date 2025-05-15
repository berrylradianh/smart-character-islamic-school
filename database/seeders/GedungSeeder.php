<?php

namespace Database\Seeders;

use App\Models\SchoolLocation;
use App\Models\Gedung;
use Illuminate\Database\Seeder;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all school locations
        $schoolLocations = SchoolLocation::all();

        if ($schoolLocations->isEmpty()) {
            $this->command->info('No school locations found. Please seed SchoolLocation first.');
            return;
        }

        $gedungs = [
            [
                'nama_gedung' => 'Gedung A',
            ],
            [
                'nama_gedung' => 'Gedung B',
            ],
            [
                'nama_gedung' => 'Gedung C',
            ],
            [
                'nama_gedung' => 'Gedung Laboratorium',
            ],
        ];

        foreach ($schoolLocations as $location) {
            foreach ($gedungs as $gedung) {
                Gedung::create([
                    'school_location_id' => $location->id,
                    'nama_gedung' => $gedung['nama_gedung'] . ' - ' . $location->nama_lokasi,
                ]);
            }
        }
    }
}
