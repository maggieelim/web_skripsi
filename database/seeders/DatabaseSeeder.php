<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([AcademicYearsTableSeeder::class, SemestersTableSeeder::class, PermissionsTableSeeder::class, RolesTableSeeder::class]);
    }
}
