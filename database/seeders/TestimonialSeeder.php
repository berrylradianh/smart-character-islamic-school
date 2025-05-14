<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        Testimonial::create([
            'name' => 'UU Ruzhanul Ulum',
            'position' => 'Wakil Gubernur Jawa Barat',
            'text' => 'Saya merasa bangga dan bahagia, disamping bangunan SCIS yang sangat hebat, para santri dididik untuk menjadi probadi yang cerdas, berprestasi, berwawasan luas, serta memiliki akhlak yang baik',
            'image' => 'testimonial_images/tSTYeldHhlLGdCOK3yHYpiW5MVp8Ze1U15cDsaHN.png',
            'rating' => 5,
            'order' => 1,
        ]);
        Testimonial::create([
            'name' => 'John Doe',
            'position' => 'Pendidik',
            'text' => 'SCIS memberikan pendidikan yang luar biasa, menggabungkan nilai agama dan teknologi modern.',
            'image' => 'testimonial_images/tSTYeldHhlLGdCOK3yHYpiW5MVp8Ze1U15cDsaHN.png',
            'rating' => 4,
            'order' => 2,
        ]);
        Testimonial::create([
            'name' => 'Jane Smith',
            'position' => 'Orang Tua Siswa',
            'text' => 'Anak saya berkembang pesat di SCIS, baik secara akademik maupun akhlak.',
            'image' => "testimonial_images/tSTYeldHhlLGdCOK3yHYpiW5MVp8Ze1U15cDsaHN.png",
            'rating' => 5,
            'order' => 3,
        ]);
        Testimonial::create([
            'name' => 'Ahmad Yani',
            'position' => 'Alumni',
            'text' => 'Pengalaman belajar di SCIS sangat membekas, saya siap menghadapi tantangan global!',
            'image' => "testimonial_images/tSTYeldHhlLGdCOK3yHYpiW5MVp8Ze1U15cDsaHN.png",
            'rating' => 5,
            'order' => 4,
        ]);
    }
}
