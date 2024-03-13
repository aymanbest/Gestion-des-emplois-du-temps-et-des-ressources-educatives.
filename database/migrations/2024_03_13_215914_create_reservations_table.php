<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('schedule_id');
            $table->string('day_of_week', 10)->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->dateTime('date');
            $table->timestamps();
    
            $table->foreign('classroom_id')->references('classroom_id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('schedule_id')->references('schedule_id')->on('schedules')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
