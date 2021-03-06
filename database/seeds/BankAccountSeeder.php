<?php

use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            ['account_name' => 'SUDUT NEGERI', 'account_number' => '12 90 7 36 592', 'bank_address' => 'Tembalang'],
            ['account_name' => 'SUDUT NEGERI', 'account_number' => '19 30 8 92 001', 'bank_address' => 'Tembalang'],
            ['account_name' => 'SUDUT NEGERI', 'account_number' => '98 87 6 412', 'bank_address' => 'Tembalang'],
            ['account_name' => 'SUDUT NEGERI', 'account_number' => '88 71 6 192', 'bank_address' => 'Tembalang'],
        ];

        foreach($accounts as $a){
            DB::table('bank_accounts')->insert($a);
        }
    }
}
