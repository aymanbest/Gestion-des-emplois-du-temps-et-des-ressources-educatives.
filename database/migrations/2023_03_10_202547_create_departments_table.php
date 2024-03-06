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
        Schema::dropIfExists('departments');

        Schema::create('departments', function (Blueprint $table) {
            $table->id('department_id');
            $table->string('department_code')->nullable()->unique();
            $table->string('name', 50)->nullable();
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
        Schema::dropIfExists('departments');
    }
};
