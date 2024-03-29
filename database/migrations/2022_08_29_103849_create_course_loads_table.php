<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_loads', function (Blueprint $table) {
            $table->id();
            $table->integer('curriculum_id');
            $table->string('period');
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('room');
            $table->string('faculty_id');
            $table->string('subject_id');
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
        Schema::dropIfExists('course_loads');
    }
}
