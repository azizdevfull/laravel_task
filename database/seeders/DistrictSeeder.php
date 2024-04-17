<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders\districts.json'));
        $data = json_decode($json, true);

        $districts = $data['Data']['table_districts']['districts'];

        foreach ($districts as $district) {
            District::create([
                'id' => $district['_id'],
                'region_id' => $district['_region_id'],
                'name' => $district['_name_uz'],
            ]);
        }
    }
}
