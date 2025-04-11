<?php

namespace Database\Seeders;

use App\Models\DashboardStat;
use Illuminate\Database\Seeder;

class DashboardStatSeeder extends Seeder
{
    public function run()
    {
        DashboardStat::create([
            'name' => 'Staff',
            'value' => 43225,
            'previous_period_percentage' => 75,
            'icon' => 'dashboard/icons/staff.png',
            'color' => '#3b82f6',
        ]);

        DashboardStat::create([
            'name' => 'Peserta Didik',
            'value' => 73265,
            'previous_period_percentage' => 88,
            'icon' => 'dashboard/icons/student.png',
            'color' => 'rgb(25, 194, 22)',
        ]);

        DashboardStat::create([
            'name' => 'Alumni',
            'value' => 447,
            'previous_period_percentage' => 68,
            'icon' => 'dashboard/icons/alumni.png',
            'color' => 'rgb(200, 200, 11)',
        ]);

        DashboardStat::create([
            'name' => 'Pendaftar',
            'value' => 86,
            'previous_period_percentage' => 82,
            'icon' => 'dashboard/icons/pendaftar.png',
            'color' => 'rgb(194, 22, 22)',
        ]);
    }
}
