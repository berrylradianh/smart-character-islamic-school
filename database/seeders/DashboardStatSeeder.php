<?php

namespace Database\Seeders;

use App\Models\DashboardStat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardStatSeeder extends Seeder
{
    public function run()
    {
        $destinationPath = public_path('storage/dashboard/icons');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $stats = [
            [
                'name' => 'Staff',
                'value' => 43225,
                'previous_period_percentage' => 75,
                'icon' => 'dashboard/icons/staff.png',
                'color' => '#3b82f6',
                'progress_bar_color' => '#3b82f6',
                'source_image' => public_path('dashboard/assets/images/staff.png'),
            ],
            [
                'name' => 'Peserta Didik',
                'value' => 73265,
                'previous_period_percentage' => 88,
                'icon' => 'dashboard/icons/student.png',
                'color' => 'rgb(25, 194, 22)',
                'progress_bar_color' => 'rgb(25, 194, 22)',
                'source_image' => public_path('dashboard/assets/images/student.png'),
            ],
            [
                'name' => 'Alumni',
                'value' => 447,
                'previous_period_percentage' => 68,
                'icon' => 'dashboard/icons/alumni.png',
                'color' => 'rgb(200, 200, 11)',
                'progress_bar_color' => 'rgb(200, 200, 11)',
                'source_image' => public_path('dashboard/assets/images/alumni.png'),
            ],
            [
                'name' => 'Pendaftar',
                'value' => 86,
                'previous_period_percentage' => 82,
                'icon' => 'dashboard/icons/pendaftar.png',
                'color' => 'rgb(194, 22, 22)',
                'progress_bar_color' => 'rgb(194, 22, 22)',
                'source_image' => public_path('dashboard/assets/images/pendaftar.png'),
            ],
        ];

        foreach ($stats as $stat) {
            $sourceImage = $stat['source_image'];
            $destinationImage = public_path('storage/' . $stat['icon']);

            if (File::exists($sourceImage)) {
                $destinationDir = dirname($destinationImage);
                if (!File::exists($destinationDir)) {
                    File::makeDirectory($destinationDir, 0755, true);
                }
                // Salin file
                File::copy($sourceImage, $destinationImage);
            }

            DashboardStat::create([
                'name' => $stat['name'],
                'value' => $stat['value'],
                'previous_period_percentage' => $stat['previous_period_percentage'],
                'icon' => $stat['icon'],
                'color' => $stat['color'],
                'progress_bar_color' => $stat['progress_bar_color'],
            ]);
        }
    }
}
