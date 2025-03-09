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
            // Add year and section columns, but only for students
            $table->integer('year')->nullable()->after('status');
            $table->string('section')->nullable()->after('year');
        });

        // Update users with 'student' role to set year and section
        \DB::table('users')->where('role', 'student')->update([
            'year' => 1,  // Set default year (you can adjust this as needed)
            'section' => 'A'  // Set default section (you can adjust this as needed)
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop year and section columns
            $table->dropColumn(['year', 'section']);
        });
    }
};
