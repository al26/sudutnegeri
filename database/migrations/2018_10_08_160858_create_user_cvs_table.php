<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cvs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_profile_id');  
            $table->foreign('user_profile_id')->references('id')->on('user_profiles')->onDelete('cascade');            
            $table->string('education')->nullable();
            $table->string('foreign_lang')->nullable();
            $table->text('pro_exp')->nullable();
            $table->text('org_exp')->nullable();
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
        Schema::dropIfExists('user_cvs');
    }
}
