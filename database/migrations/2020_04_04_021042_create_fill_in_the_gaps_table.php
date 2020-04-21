<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillInTheGapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fill_in_the_gaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id');
            $table->foreignId('set_id');
            $table->string('sentence');
            $table->foreignId('fill_in_the_gap_option_id');
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
        Schema::dropIfExists('fill_in_the_gaps');
    }
}
