<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    public function index()
    {
        $student_list = User::where('role', 'student')->get();
        return view('components.admin.student-table', compact('student_list'));
    }
    

    public function create()
     {
    //     return view('components.student.create');
    }
    public function store(StoreStudentRequest $request)
    {
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => 'student', 
            'student_id' => User::generateStudentId(),
            'password' => bcrypt('defaultpassword123'),
            'status' => 'unenrolled',
        ]);
    
        return redirect()->route('admin-dashboard')
            ->with('activeComponent', 'student-component')
            ->with('success', 'Student added successfully!');
    }

    // Display the specified resource (show).
    public function show($id)
    {
        return view('components.student.show', compact('id'));
    }

    public function edit($id)
    {
        return view('components.student.edit', compact('id'));
    }

   
    public function update(UpdateStudentRequest $request, $id)
    {
        $student = User::where('student_id', $id)->first();
    
        if (!$student) {
            return response()->json(['error' => 'Student not found!'], 404);
        }
    
        $student->update([
            'name' => $request->name,
        ]);
    
        return response()->json(['message' => 'Student updated successfully!']);
    }
    



    public function destroy($student_id)
    {
        $student = User::where('student_id', $student_id)->where('role', 'student')->first();
    
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }
    
        // Check if student is currently enrolled
        $isEnrolled = Enrollment::where('student_id', $student->id)->exists();
    
        if ($isEnrolled) {
            return response()->json(['error' => 'Cannot delete student. The student is currently enrolled.'], 400);
        }
    
        try {
            $student->delete();
            \Log::info('Successfully deleted student'); // Debugging
    
            return response()->json([
                'message' => 'Student deleted successfully!',
                'student' => $student
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Cannot delete student: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong during deletion.'], 500);
        }
    }

}
