<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('undergraduate')->nullable();
            $table->string('graduate')->nullable();
            $table->string('post_graduate')->nullable();
            $table->string('professional_license')->nullable();
            $table->string('name_of_company')->nullable();
            $table->string('length_of_teaching')->nullable();
            $table->string('field')->nullable();
            $table->string('subj_taught')->nullable();
            $table->string('nature_of_appt')->nullable();
            $table->string('status')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
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
        Schema::dropIfExists('faculties');
    }
}
