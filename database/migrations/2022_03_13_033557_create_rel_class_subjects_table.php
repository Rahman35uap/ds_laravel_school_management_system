<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelClassSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_class_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('class_numbers'); // for class FK
            $table->foreignId('subject_id')->constrained('subjects'); // for subject FK
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
        Schema::dropIfExists('rel_class_subjects');
    }
}
