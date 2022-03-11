<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelSubjectTeacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rel_subject_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects'); // for subject FK
            $table->foreignId('teacher_id')->constrained('users'); // for teacher FK
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
        //
        Schema::dropIfExists('rel_subject_teacher');
    }
}
