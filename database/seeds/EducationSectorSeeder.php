<?php

use Illuminate\Database\Seeder;

class EducationSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::get("json_data/education_sectors.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('education_sectors')->insert(
                [
                    "sector" => $obj->sector,
                ]
            );
        }
    }
}
