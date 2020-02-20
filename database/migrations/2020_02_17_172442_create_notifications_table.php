<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('question_template_id');
            $table->string('mail_subject');
            $table->string('notice');
            $table->string('duration');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
        Schema::dropIfExists('exam_notifications');
    }
}
