<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $enrollments = Enrollment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        $months = $enrollments->pluck('month')->toArray();
        $counts = $enrollments->pluck('count')->toArray();
    
        $total_students = User::where('role', 'student')->count();
        $total_enrolled = Enrollment::count();
        $total_subjects = Subject::count();
    
        return view('components.admin.dashboard', compact('total_subjects', 'total_enrolled', 'total_students', 'months', 'counts'));
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
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
