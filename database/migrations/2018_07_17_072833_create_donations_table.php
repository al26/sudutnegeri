<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('project_id');  
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->string('bank_code');  
            $table->foreign('bank_code')->references('bank_code')->on('banks')->onDelete('cascade');
            $table->unsignedInteger('amount');
            $table->unsignedSmallInteger('payment_code');
            $table->boolean('anonymouse')->default(false);
            $table->enum('status', ['unverified', 'pending', 'verified']);
            $table->string('transfer_receipt')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
