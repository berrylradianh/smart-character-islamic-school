<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run()
    {
        Media::create([
            'name' => 'Kabar Periangan',
            'image' => 'media_images/kabar-periangan.png',
            'order' => 1,
        ]);
        Media::create([
            'name' => 'Kapol',
            'image' => 'media_images/kapol.png',
            'order' => 2,
        ]);
        Media::create([
            'name' => 'Priangan.com',
            'image' => 'media_images/priangan.png',
            'order' => 3,
        ]);
        Media::create([
            'name' => 'Tribunnews',
            'image' => 'media_images/tribunnews.png',
            'order' => 4,
        ]);
    }
}
