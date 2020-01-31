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
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->foreign('department_id')->on('departments')->references('id')->onDelete('cascade');
            $table->foreign('subject_id')->on('subjects')->references('id')->onDelete('cascade');
            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->tinyInteger('is_deleted')->nullable()->default(0);
            $table->string('description')->nullable();
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
