<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BankSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(RegencySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(AdminSeeder::class);
        // $this->call(VillageSeeder::class);
    }
}
