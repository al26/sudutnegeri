<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('project_id');  
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->string('account_number');
            // $table->string('bank_code');  
            // $table->foreign('bank_code')->references('bank_code')->on('banks')->onDelete('cascade');
            $table->unsignedInteger('bank_id');  
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->string('account_name');
            $table->unsignedInteger('amount');
            $table->enum('status', ['pending', 'processed', 'confirmed']);
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('withdrawals');
    }
}
