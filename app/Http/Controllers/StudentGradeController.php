<?php

namespace App\Http\Controllers;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class StudentGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(){
        $studentId = auth()->id(); 

        $enrollment = Enrollment::where('student_id', $studentId)->first();

        if (!$enrollment) {
            return view('components.student.grades', [
                'student' => auth()->user(),
                'course' => 'Not yet enrolled',  
                'grades' => [],
                 'remarks' => []
            ]);
        }

        $student = auth()->user();
        $course = $enrollment->course_name ?? 'Unknown Course'; 
        $grades = $enrollment->subjects ?? []; 
        $remarks = [];
        
        foreach ($grades as $subject => $grade) {
            if (!is_numeric($grade)) {
                $remarks[$subject] = 'Invalid Grade';
            } elseif ($grade >= 1.0 && $grade <= 3.0) {
                $remarks[$subject] = 'Pass';
            } else {
                $remarks[$subject] = 'Failed';
            }
        }

        return view('components.student.grades', compact('student', 'course', 'grades','remarks'));
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
