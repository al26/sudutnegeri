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
            $table->increments('id');
            $table->unsignedInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
            $table->string('project_name');
            $table->string('project_slug');
            $table->text('project_description');
            $table->string('project_location');
            $table->dateTime('project_deadline');
            $table->unsignedInteger('funding_target');
            $table->unsignedInteger('funding_progress');
            $table->unsignedInteger('volunteer_quota');
            $table->unsignedInteger('registered_volunteer');
            $table->string('project_banner');
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
        Schema::dropIfExists('projects');
    }
}
