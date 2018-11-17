<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $json = File::get(storage_path("app/json_data/districts.json"));
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('districts')->insert(
                [
                    "id" => $obj->id,
                    "regency_id" => $obj->regency_id,
                    "name" => $obj->name,
                ]
            );
        }
        
    }
}
