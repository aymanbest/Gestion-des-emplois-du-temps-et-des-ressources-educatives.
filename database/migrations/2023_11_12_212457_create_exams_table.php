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
        Schema::create('exams', function (Blueprint $table) {
            $table->id('exam_id');

            $table->unsignedBigInteger('module_id')->nullable()->index();
            $table->unsignedBigInteger('semester_id')->nullable()->index();
            $table->unsignedBigInteger('classroom_id')->nullable()->index();

            $table->string('teacher_ids')->nullable()->index();
            $table->string('group_ids')->nullable()->index();

            $table->date('day')->nullable()->index();

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->boolean('touched')->nullable()->default(false);

            $table->timestamps();

            $table->foreign('module_id')->references('module_id')->on('modules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('semester_id')->references('semester_id')->on('semesters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('classroom_id')->references('classroom_id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
