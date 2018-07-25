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
            ['bank_name' => 'BNI', 'bank_code' => '009', 'logo' => 'storage/bank_logo/bni.png', 'account_name' => 'SUDUT NEGERI', 'account_number' => '12 90 7 36 592', 'bank_address' => 'Tembalang'],
            ['bank_name' => 'BRI', 'bank_code' => '002', 'logo' => 'storage/bank_logo/bri.png', 'account_name' => 'SUDUT NEGERI', 'account_number' => '19 30 8 92 001', 'bank_address' => 'Tembalang'],
            ['bank_name' => 'BTN', 'bank_code' => '200', 'logo' => 'storage/bank_logo/btn.png', 'account_name' => 'SUDUT NEGERI', 'account_number' => '98 87 6 412', 'bank_address' => 'Tembalang'],
            ['bank_name' => 'Mandiri', 'bank_code' => '008', 'logo' => 'storage/bank_logo/mandiri.png', 'account_name' => 'SUDUT NEGERI', 'account_number' => '88 71 6 192', 'bank_address' => 'Tembalang'],
        ];

        foreach($banks as $bank){
            DB::table('banks')->insert($bank);
        }
    }
}