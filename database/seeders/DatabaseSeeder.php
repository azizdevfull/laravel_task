<?php

namespace Database\Seeders;

use Database\Seeders\BranchSeeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\DistrictSeeder;
use Database\Seeders\RegionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            DistrictSeeder::class,
            BrandSeeder::class,
            BranchSeeder::class
        ]);
    }
}
