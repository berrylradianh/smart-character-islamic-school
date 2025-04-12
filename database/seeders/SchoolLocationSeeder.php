<?php

namespace Database\Seeders;

use App\Models\SchoolLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SchoolLocation::create(['nama_lokasi' => 'SCIS Pusat', 'alamat' => 'Jl. Situ Bojong Kel. Tamanjaya, Kec. Tamansari, Kota Tasikmalaya. ', 'kontak' => '08123456789']);
        SchoolLocation::create(['nama_lokasi' => 'SCIS Cabang', 'alamat' => 'Jl. Situ Bojong Kel. Tamanjaya, Kec. Tamansari, Kota Tasikmalaya.', 'kontak' => '08198765432']);
    }
}
