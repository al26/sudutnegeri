<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
            $table->string('name');
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->date('dob')->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('biography')->nullable();
            $table->string('profession')->nullable();
            $table->string('institution')->nullable();
            $table->string('interest')->nullable();
            $table->string('skills')->nullable();
            $table->string('profile_picture')->default('storage/profile_pictures/avatar.jpg');
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
        Schema::dropIfExists('user_profiles');
    }
}
