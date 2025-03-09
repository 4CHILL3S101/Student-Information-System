<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('year_level');
            $table->string('section');
            $table->string('semester');
            $table->string('course_name');
            $table->json('subjects'); 
            $table->timestamps();

            // Foreign key to users table
            $table->foreign('student_id')->references('id')->on('users')->onDelete('restrict');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
