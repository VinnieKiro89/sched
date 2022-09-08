<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('curriculum_id');
            $table->string('period');
            $table->string('level');
            $table->string('subject_code');
            $table->string('subject_title');
            $table->string('cred_units');
            $table->string('subj_hours');
            $table->string('pre_requisite')->nullable();
            $table->string('co_requisite')->nullable();
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
        Schema::dropIfExists('subjects');
    }
}
