<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $json = File::get(storage_path("app/json_data/regencies.json"));
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('regencies')->insert(
                [
                    "id" => $obj->id,
                    "province_id" => $obj->province_id,
                    "name" => $obj->name,
                ]
            );
        }
        
    }
}
