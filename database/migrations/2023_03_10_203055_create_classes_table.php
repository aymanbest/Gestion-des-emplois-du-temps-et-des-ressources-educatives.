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
        Schema::dropIfExists('classes');

        Schema::create('classes', function (Blueprint $table) {
            $table->id('class_id');
            $table->string('class_code')->nullable()->unique()->index();
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('department_id')->nullable()->index();
            $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
