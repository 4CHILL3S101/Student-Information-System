<?php

namespace App\Http\Controllers;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class StudentDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $studentId = auth()->id();
    $enrollment = Enrollment::where('student_id', $studentId)->first();

    if (!$enrollment) {
        return view('components.student.student-dashboard', [
            'course' => 'Not yet enrolled',
            'grades' => [],
            'gpa' => null,
            'bestSubject' => null,
            'bestGrade' => null,
            'weakestSubject' => null,
            'weakestGrade' => null,
            'gradeSubjects' => [],
            'gradeScores' => [],
        ]);
    }

    $course = $enrollment->course_name ?? 'Unknown Course';
    $grades = $enrollment->subjects ?? [];

    // Convert grades to numeric and filter valid values
    $numericGrades = array_filter($grades, function ($grade) {
        return is_numeric($grade);
    });

    // GPA Calculation (Average of all grades)
    $gpa = count($numericGrades) > 0 ? array_sum($numericGrades) / count($numericGrades) : null;

    // Best & Weakest Subjects
    $bestSubject = null;
    $bestGrade = null;
    $weakestSubject = null;
    $weakestGrade = null;

    if (!empty($numericGrades)) {
        $bestGrade = min($numericGrades);
        $bestSubject = array_search($bestGrade, $grades);

        $weakestGrade = max($numericGrades);
        $weakestSubject = array_search($weakestGrade, $grades);
    }


    
    return view('components.student.student-dashboard', compact(
        'course', 'grades', 'gpa', 'bestSubject', 'bestGrade', 'weakestSubject', 'weakestGrade' 
    ));
}

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
