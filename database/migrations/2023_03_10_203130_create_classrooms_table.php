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
        Schema::dropIfExists('classrooms');

        Schema::create('classrooms', function (Blueprint $table) {
            $table->id('classroom_id');
            $table->string('classroom_code')->nullable()->unique()->index();
            $table->string('name', 10)->nullable()->unique();
            $table->integer('cours_seats')->nullable()->default(0);
            $table->integer('exam_seats')->nullable()->default(0);
            $table->integer('supervisors_capacity')->nullable()->default(0);
            $table->unsignedBigInteger('faculty_id')->nullable()->index();
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
