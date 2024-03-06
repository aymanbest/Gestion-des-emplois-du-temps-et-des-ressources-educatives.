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
        Schema::dropIfExists('teachers');

        Schema::create('teachers', function (Blueprint $table) {
            $table->id('teacher_id');
            $table->string('fullname', 255)->nullable();
            $table->unsignedBigInteger('teacher_type_id')->nullable()->index();
            $table->foreign('teacher_type_id')->references('teacher_type_id')->on('teacher_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
