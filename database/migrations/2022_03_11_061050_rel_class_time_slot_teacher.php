<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelClassTimeSlotTeacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rel_class_time_slots_', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_id')->constrained('class_time_slots');
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
        //
        Schema::dropIfExists('');
    }
}
