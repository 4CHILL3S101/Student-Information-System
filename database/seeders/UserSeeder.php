<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $role = $i <= 3 ? 'admin' : 'student'; 
            $studentId = ($role === 'student') ? rand(1000, 9999) : null; 
            $status = ($role === 'student') ? 'unenrolled' : null; 

            User::updateOrCreate(
                ['email' => "user$i@example.com"], 
                [
                    'name' => "User $i",
                    'email' => "user$i@example.com",
                    'student_id' => $studentId,
                    'password' => Hash::make('password'),
                    'status' => $status,
                    'year' => null,
                    'section' => null,
                    'role' => $role,
                ]
            );
        }
    }
}
