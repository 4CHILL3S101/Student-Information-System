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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->unique();
            }

            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->unique();
            }

            if (!Schema::hasColumn('users', 'student_id')) {
                $table->string('student_id')->unique()->nullable();
            }
          
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('student');
            }
            if (!Schema::hasColumn('users', 'year')) {
                $table->integer('year')->nullable();
            }
            if (!Schema::hasColumn('users', 'section')) {
                $table->string('section')->nullable();
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('unenrolled');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
