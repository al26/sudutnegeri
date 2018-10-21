<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(storage_path("app/json_data/provinces.json"));
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('provinces')->insert(
                [
                    "id"    => $obj->id,
                    "name"  => $obj->name,
                ]
            );
        }
        
    }
}
