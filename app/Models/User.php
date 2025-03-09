<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

     public static function generateStudentId()
     {
         do {
             $randomId = random_int(100000, 999999); // Generates a unique 6-digit ID
         } while (self::where('student_id', $randomId)->exists()); // Ensures it's unique

         return $randomId;
     }

    protected $fillable = [
        'name',
        'student_id',
        'email',
        'password',
        'year',
        'section',
        'status',
        'role'
    ];


    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }






    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
