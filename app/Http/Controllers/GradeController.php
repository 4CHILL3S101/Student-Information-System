<?php

namespace App\Http\Controllers;
use App\Http\Requests\GradeRequest;
use Illuminate\Validation\ValidationException;
use App\Models\Grade;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class GradeController extends Controller
{
   
    public function index()
    {
        $enrollments = Enrollment::with('student')->get();
         return view('components.admin.grade',compact('enrollments'));
    }

    public function create()
    {
        //
    }

  
    public function store(GradeRequest $request)
    {
        try {
            $validated = $request->validated(); // Validate request
    
            $enrollment = Enrollment::where('student_id', $validated['student_id'])->first();
    
            if (!$enrollment) {
                return response()->json(['message' => 'Enrollment not found'], 404);
            }
    
            $subjects = $enrollment->subjects;
    
            foreach ($validated['grades'] as $subject => $gradeValue) {
                if (array_key_exists($subject, $subjects)) {
                    $subjects[$subject] = $gradeValue;
                }
            }
    
            $enrollment->subjects = $subjects;
            $enrollment->save();
    
            return response()->json(['success' => true, 'message' => 'Grades updated successfully!']);
    
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
        }
    }
    
    

    public function show(Grade $grade)
    {
        //
    }

    public function edit(Grade $grade)
    {
    
    }

    public function update(Request $request, Grade $grade)
    {
     }
    
    
       
    

    public function destroy(Grade $grade)
    {
        //
    }
}
