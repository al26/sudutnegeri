<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(storage_path("app/json_data/categories.json"));
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('categories')->insert(
                [
                    "category" => $obj->category,
                    "slug" => str_slug($obj->category)
                ]
            );
        }
    }
}
