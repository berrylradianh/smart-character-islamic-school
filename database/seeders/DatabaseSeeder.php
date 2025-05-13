<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(FaqSeeder::class);
        $this->call(DashboardStatSeeder::class);
        $this->call(SchoolLocationSeeder::class);
        $this->call(LevelAndRegistrationInfoSeeder::class);
        $this->call(TimelineSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ValueSeeder::class);
    }
}
