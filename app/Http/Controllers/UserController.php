<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function FetchGrades(){
            return "Your grade is ";
    }


    public function Dashboard(){
        $gradeDates = ['Jan', 'Feb', 'Mar', 'Apr']; // Example data (Replace this with actual data from DB)
    $gradeScores = [85, 90, 88, 92];
    return view('components.student.dashboard', compact('gradeDates', 'gradeScores'));
    }

    public function ViewGrades(){
                return view('components.student.grades');
    }


    public function ViewAllStudents(){
            return view('components.admin.student-table');
    }


}
