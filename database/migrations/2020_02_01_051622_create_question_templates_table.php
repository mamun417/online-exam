<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->bigInteger('question_type_id')->unsigned();
            $table->foreign('department_id')->on('departments')->references('id')->onDelete('cascade');
            $table->foreign('subject_id')->on('subjects')->references('id')->onDelete('cascade');
            $table->foreign('question_type_id')->on('question_types')->references('id')->onDelete('cascade');
            $table->Integer('total_questions');
            $table->Integer('total_marks');
            $table->float('negative_marks')->nullable();
            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->tinyInteger('is_deleted')->nullable()->default(0);
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
        Schema::dropIfExists('question_templates');
    }
}
