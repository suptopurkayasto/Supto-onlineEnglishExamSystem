<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('admin_id')->default(0);
            $table->unsignedBigInteger('teacher_id')->default(0);
            $table->unsignedBigInteger('question_set_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('group_id');
            $table->string('name');
            $table->string('id_number');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

//        Schema::table('students', function(Blueprint $table) {
//            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
