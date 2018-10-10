<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('bank_code');  
            // $table->foreign('bank_code')->references('bank_code')->on('banks')->onDelete('cascade');
            $table->unsignedInteger('bank_id');  
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->string('bank_address');
            $table->string('account_name');
            $table->string('account_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}
