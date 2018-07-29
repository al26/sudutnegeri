<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('volunteer_id');  
            $table->foreign('volunteer_id')->references('id')->on('volunteers')->onDelete('cascade');
            $table->unsignedInteger('question_id');  
            $table->foreign('question_id')->references('id')->on('additional_questions')->onDelete('cascade');
            $table->text('answer');
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
        Schema::dropIfExists('additional_answers');
    }
}
