<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $json = Storage::get("json_data/villages.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('villages')->insert(
                [
                    "id" => $obj->id,
                    "district_id" => $obj->district_id,
                    "name" => $obj->name,
                ]
            );
        }
        
    }
}
