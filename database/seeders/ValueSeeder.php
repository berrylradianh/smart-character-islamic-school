<?php

namespace Database\Seeders;

use App\Models\Value;
use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    public function run()
    {
        $values = [
            [
                'title' => '3 Karakter',
                'description' => 'Fikir - Dzikir - Maslahat',
                'icon' => 'values/icons/expert.png',
                'color' => '#4A90E2',
            ],
            [
                'title' => '3 Kesadaran',
                'description' => 'Bertauhid - Berilmu - Beramal sholeh',
                'icon' => 'values/icons/social-care.png',
                'color' => '#F5A623',
            ],
            [
                'title' => '3 Kompetensi',
                'description' => 'Al Qur’an - Bahasa - Informatika',
                'icon' => 'values/icons/core-values.png',
                'color' => '#7ED321',
            ],
        ];

        foreach ($values as $value) {
            Value::create($value);
        }
    }
}
