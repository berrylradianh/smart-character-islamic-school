<?php

namespace Database\Seeders;

use App\Models\Vision;
use Illuminate\Database\Seeder;

class VisionSeeder extends Seeder
{
    public function run()
    {
        Vision::create([
            'vision_text' => '"Menjadi Lembaga Kaderisasi umat yang inklusif, berkemajuan dan berwawasan global."',
            'mission_items' => [
                'SMART adalah : Specific, Measurable, Achievable, Relevant dan Timebound.',
                'Berakhlak Mulia yaitu beradab dan berbudi pekerti mulia.',
                'Disiplin Tinggi yaitu peka dan sadar dengan diri sendiri dan lingkungan sekitar.',
                'Mandiri yaitu kuat dalam ekonomi, menguasai ilmu akuntansi dan keuangan.',
                'Kompeten yaitu ahli dalam bidang tententu dan atau segala bidang.'
            ],
            'commitment_text' => 'SCIS berkomitmen untuk membentuk pendidikan yang berlandaskan pada ajaran islam.',
            'poster_image' => 'vision_images/visi dan misi.png',
        ]);
    }
}
