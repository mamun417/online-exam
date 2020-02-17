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
            $table->bigInteger('subject_id');
            $table->string('mail_subject');
            $table->dateTime('start_date');
            $table->string('notice');
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
