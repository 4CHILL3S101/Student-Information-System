<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'course_name', 'semester', 'section', 'year_level', 'subjects'];

    // Automatically cast 'subjects' to an associative array
    protected $casts = [
        'subjects' => 'array',
    ];


    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Update a subject's grade for the enrollment.
     *
     * @param string $subjectName
     * @param float|null $grade
     * @return void
     */
    public function updateSubjectGrade(string $subjectName, ?float $grade)
    {
        $subjects = $this->subjects ?? [];
        
        if (array_key_exists($subjectName, $subjects)) {
            $subjects[$subjectName] = $grade; // Update grade
            $this->subjects = $subjects;
            $this->save();
        }
    }
}
