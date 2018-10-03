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
            $table->unsignedInteger('bank_id');  
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->unsignedInteger('amount');
            $table->unsignedSmallInteger('payment_code');
            $table->boolean('anonymouse')->default(false);
            $table->enum('status', ['unverified', 'pending', 'verified']);
            $table->string('transfer_receipt')->nullable();
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
        Schema::dropIfExists('donations');
    }
}
