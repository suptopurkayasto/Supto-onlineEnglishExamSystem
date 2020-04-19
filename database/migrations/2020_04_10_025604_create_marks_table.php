<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('exam_id');
            $table->foreignId('set_id');
            $table->unsignedInteger('grammar')->nullable();
            $table->unsignedInteger('synonym')->nullable();
            $table->unsignedInteger('definition')->nullable();
            $table->unsignedInteger('combination')->nullable();
            $table->unsignedInteger('fillInTheGap')->nullable();
            $table->unsignedInteger('rearrange')->nullable();
            $table->unsignedInteger('heading')->nullable();
            $table->unsignedInteger('dialog')->nullable();
            $table->unsignedInteger('informalEmail')->nullable();
            $table->unsignedInteger('formalEmail')->nullable();
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
        Schema::dropIfExists('marks');
    }
}
