<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
         

            User::updateOrCreate(
            
                [
                    'name' => "User $i",
                    'email' => "user$i@example.com",
                    'student_id' => $studentId, // Only for students
                    'password' => Hash::make('password'),
                    'status' => $status, // Only for students
                    'year' => null,
                    'section' => null,
                    'role' => $role,
                ]
            );
        }
    }
}
