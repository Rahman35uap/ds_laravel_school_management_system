<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelClassSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rel_class_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('class_sections'); // for class + section FK
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
        Schema::dropIfExists('rel_class_subject');
    }
}
