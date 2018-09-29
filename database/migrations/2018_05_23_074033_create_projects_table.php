<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->string('project_name');
            $table->string('project_slug');
            $table->text('project_description');
            $table->string('regency_id')->nullable();
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('set null');            
            $table->unsignedInteger('funding_target');
            $table->unsignedInteger('funding_progress')->nullable();
            $table->unsignedInteger('volunteer_quota');
            $table->unsignedInteger('registered_volunteer')->nullable();
            $table->dateTime('close_donation');
            $table->dateTime('close_reg');
            $table->string('project_banner')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Schema::table('projects', function($table) {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
        //     $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        //     // $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('set null');            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
