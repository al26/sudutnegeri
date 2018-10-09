<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['bank_name' => 'BNI', 'bank_code' => '009', 'logo' => 'storage/bank_logo/bni.png'],
            ['bank_name' => 'BRI', 'bank_code' => '002', 'logo' => 'storage/bank_logo/bri.png'],
            ['bank_name' => 'BTN', 'bank_code' => '200', 'logo' => 'storage/bank_logo/btn.png'],
            ['bank_name' => 'Mandiri', 'bank_code' => '008', 'logo' => 'storage/bank_logo/mandiri.png'],
        ];

        foreach($banks as $bank){
            DB::table('banks')->insert($bank);
        }
    }
}
