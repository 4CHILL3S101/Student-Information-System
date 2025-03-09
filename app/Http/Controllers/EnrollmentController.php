<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Http\Requests\AddEnrollmentRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    
    public function index()
    {
        $unenrolled_students = User::where('role', 'student')->where('status', 'unenrolled')->get();
        $fetched_subjects = Subject::all(['id', 'name', 'units']); 
        $enrolled_students = User::where('role', 'student')->where('status', 'enrolled')->get();
        $course_details = [
            'Computer Science' => 'Computer Science',
            'Bachelor of Science in Information Technology' => 'Bachelor of Science in Information Technology',
            'Bachelor of Business Administration' => 'Bachelor of Business Administration',
            'Engineering' => 'Engineering',
            'Education' => 'Education',
            'Bachelor of Science in Computer Engineering' => 'Bachelor of Science in Computer Engineering',
            'Bachelor of Science in Mechanical Engineering' => 'Bachelor of Science in Mechanical Engineering',
            'Bachelor of Science in Civil Engineering' => 'Bachelor of Science in Civil Engineering',
            'Bachelor of Science in Electrical Engineering' => 'Bachelor of Science in Electrical Engineering',
            'Bachelor of Science in Electronics and Communications Engineering' => 'Bachelor of Science in Electronics and Communications Engineering',
            'Bachelor of Science in Information Systems' => 'Bachelor of Science in Information Systems',
            'Bachelor of Science in Software Engineering' => 'Bachelor of Science in Software Engineering',
            'Bachelor of Science in Business Management' => 'Bachelor of Science in Business Management',
            'Bachelor of Science in Accounting' => 'Bachelor of Science in Accounting',
            'Bachelor of Science in Entrepreneurship' => 'Bachelor of Science in Entrepreneurship',
            'Bachelor of Science in Marketing' => 'Bachelor of Science in Marketing',
            'Bachelor of Science in Psychology' => 'Bachelor of Science in Psychology',
            'Bachelor of Science in Sociology' => 'Bachelor of Science in Sociology',
            'Bachelor of Science in Political Science' => 'Bachelor of Science in Political Science',
            'Bachelor of Arts in Communication' => 'Bachelor of Arts in Communication',
            'Bachelor of Arts in Journalism' => 'Bachelor of Arts in Journalism',
            'Bachelor of Science in Nursing' => 'Bachelor of Science in Nursing',
            'Bachelor of Science in Medical Technology' => 'Bachelor of Science in Medical Technology',
            'Bachelor of Science in Pharmacy' => 'Bachelor of Science in Pharmacy',
            'Bachelor of Science in Physical Therapy' => 'Bachelor of Science in Physical Therapy',
            'Bachelor of Science in Biology' => 'Bachelor of Science in Biology',
            'Bachelor of Science in Environmental Science' => 'Bachelor of Science in Environmental Science',
            'Bachelor of Science in Mathematics' => 'Bachelor of Science in Mathematics',
            'Bachelor of Science in Physics' => 'Bachelor of Science in Physics',
            'Bachelor of Science in Chemistry' => 'Bachelor of Science in Chemistry',
            'Bachelor of Science in Hospitality Management' => 'Bachelor of Science in Hospitality Management',
            'Bachelor of Science in Tourism Management' => 'Bachelor of Science in Tourism Management',
            'Bachelor of Science in Criminology' => 'Bachelor of Science in Criminology',
        ];
    
        return view('components.admin.enrollment', compact('unenrolled_students', 'fetched_subjects', 'course_details','enrolled_students'));
    }
    

  
    public function store(AddEnrollmentRequest $request)
    {
        $latestEnrollment = Enrollment::where('student_id', $request->student_id)
            ->orderBy('created_at', 'desc')
            ->first();
    
        $yearLevel = $latestEnrollment ? $this->incrementYearLevel($latestEnrollment->year_level) : '1st Year';
    
        $section = $this->assignSection($request->course_name, $yearLevel, $request->semester);
    
        if (Enrollment::where('student_id', $request->student_id)
            ->where('year_level', $yearLevel)
            ->where('semester', $request->semester)
            ->exists()) {
            return response()->json([
                'errors' => ['duplicate' => 'This student is already enrolled in the selected year and semester.']
            ], 422);
        }
    
        $subjectsWithGrades = [];
        foreach ($request->subjects as $subjectId) {
            $subjectName = Subject::where('id', $subjectId)->value('name');
            if ($subjectName) {
                $subjectsWithGrades[$subjectName] = null;
            }
        }
    
        Enrollment::create([
            'student_id' => $request->student_id,
            'year_level' => $yearLevel,
            'semester' => $request->semester,
            'section' => $section,
            'course_name' => $request->course_name,
            'subjects' => $subjectsWithGrades,
        ]);
    

        User::where('id', $request->student_id)->update(['status' => 'enrolled']);
    
        return redirect()->route('admin-dashboard')->with([
            'activeComponent' => 'enroll-component',
            'success' => 'Student added successfully!',
        ]);
    }
    

    private function incrementYearLevel($currentYearLevel)
            {
                $yearLevels = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
                
                $currentIndex = array_search($currentYearLevel, $yearLevels);

                return ($currentIndex !== false && $currentIndex < count($yearLevels) - 1)
                    ? $yearLevels[$currentIndex + 1]
                    : $currentYearLevel; 
            }

    private function assignSection($courseName, $yearLevel, $semester){
        $count = Enrollment::where('course_name', $courseName)
            ->where('year_level', $yearLevel)
            ->where('semester', $semester)
            ->count();

        $sections = ['A', 'B', 'C', 'D'];

        return $sections[min(intval($count / 30), count($sections) - 1)];
    }
    
    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
       
    }

    public function destroy(string $studentId)
    {
        \Log::info('Checking studentId:', ['studentId' => $studentId]);
        $student = User::whereNotNull('student_id')->where('id', $studentId)->first();

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }

        $enrollment = Enrollment::where('student_id', $studentId)->first();
        
        if (!$enrollment) {
            return response()->json(['success' => false, 'message' => 'Enrollment not found'], 404);
        }
    
        $enrollment->delete();
        
        $student_update_status = User::where('id', $studentId)->first();
    
        if (!$student_update_status) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }
    
          $student_update_status->update(['status' => 'unenrolled']); 
    
        return response()->json(['success' => true, 'message' => 'Enrollment deleted and student marked as unenrolled']);
    }
    
    
}
