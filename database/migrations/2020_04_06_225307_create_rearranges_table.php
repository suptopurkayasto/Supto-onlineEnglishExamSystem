<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRearrangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rearranges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id');
            $table->foreignId('question_set_id');
            $table->string('line_1');
            $table->string('line_2');
            $table->string('line_3');
            $table->string('line_4');
            $table->string('line_5');
            $table->string('line_6');
            $table->string('line_7');
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
        Schema::dropIfExists('rearranges');
    }
}
