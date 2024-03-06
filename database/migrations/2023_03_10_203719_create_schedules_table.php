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
        Schema::dropIfExists('schedules');

        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id');

            $table->unsignedBigInteger('year_id')->nullable()->index();
            $table->unsignedBigInteger('semester_id')->nullable()->index();
            $table->unsignedBigInteger('group_id')->nullable()->index();
            $table->unsignedBigInteger('class_id')->nullable()->index();

            $table->unsignedBigInteger('module_id')->nullable()->index();
            $table->unsignedBigInteger('teacher_id')->nullable()->index();
            $table->unsignedBigInteger('classroom_id')->nullable()->index();

            $table->string('day_of_week', 10)->nullable()->index();
            $table->time('start_time')->nullable()->index();
            $table->time('end_time')->nullable()->index();

            $table->foreign('year_id')->references('year_id')->on('years')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('semester_id')->references('semester_id')->on('semesters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('class_id')->references('class_id')->on('classes')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('module_id')->references('module_id')->on('modules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('classroom_id')->references('classroom_id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
