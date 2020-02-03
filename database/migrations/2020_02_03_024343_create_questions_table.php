<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->bigInteger('question_template_id')->unsigned();
            $table->foreign('question_template_id')->on('question_templates')->references('id')->onDelete('cascade');
            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->tinyInteger('is_deleted')->nullable()->default(0);
            $table->string('description', 500)->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
