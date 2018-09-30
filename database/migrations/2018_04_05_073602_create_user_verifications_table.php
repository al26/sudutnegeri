<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_profile_id');  
            $table->foreign('user_profile_id')->references('id')->on('user_profiles')->onDelete('cascade'); 
            $table->string('scan_id_card');
            $table->string('verification_picture');
            $table->status('enum', ['pending', 'unverified', 'verified']);
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
        Schema::dropIfExists('user_verifications');
    }
}
