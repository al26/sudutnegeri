<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_profile_id');  
            $table->foreign('user_profile_id')->references('id')->on('user_profiles')->onDelete('cascade');
            $table->string('province_id', 2);  
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->string('regency_id', 4);  
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->string('district_id', 7);  
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->string('village_id', 10);  
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
