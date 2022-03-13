<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelClassTimeTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_class_time_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_time_id')->constrained('class_times');
            $table->foreignId('teacher_id')->constrained('users');
            $table->boolean('free');
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
        Schema::dropIfExists('rel_class_time_teachers');
    }
}
