<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function run()
{
    for ($i = 0; $i < 10; $i++) {
        $email = 'user' . ($i + 1) . '@example.com';
        $role = $i < 3 ? 'admin' : 'student'; // First 3 users are admins, the rest are students

        // Only assign year and section for students
        $year = $role === 'student' ? rand(1, 4) : null;  // Random year (1 to 4) for students, null for admins
        $section = $role === 'student' ? chr(65 + $i) : null; // Random section (A, B, C, etc.) for students, null for admins

        // Insert user with conditional year and section
        User::create([
            'name' => 'User ' . ($i + 1),
            'email' => $email,
            'password' => bcrypt('password'),
            'role' => $role,  // Admin or Student
            'status' => 'unenrolled',
            'year' => $year,   // Only for students
            'section' => $section,  // Only for students
        ]);
    }
}

};
