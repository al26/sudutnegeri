<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');  
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->text('question');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_questions');
    }
}
