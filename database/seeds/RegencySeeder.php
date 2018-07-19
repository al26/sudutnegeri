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
        $json = Storage::get("json_data/regencies.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('regencies')->insert($obj);
        }
        
    }
}
