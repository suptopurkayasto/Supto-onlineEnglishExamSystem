<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDialogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialogs', function (Blueprint $table) {
            $table->id();
            $table->string('part')->default('writing');
            $table->foreignId('student_id');
            $table->foreignId('exam_id')->nullable();
            $table->foreignId('question_set_id');
            $table->text('title');
            $table->text('subtitle');
            $table->text('question_1');
            $table->text('question_2');
            $table->text('question_3');
            $table->longText('answer_1');
            $table->longText('answer_2');
            $table->longText('answer_3');
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
        Schema::dropIfExists('dialogs');
    }
}
