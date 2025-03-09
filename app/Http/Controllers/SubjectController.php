<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
            return view('components.admin.subject-table',compact('subjects'));
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
    public function store(SubjectRequest $request)
    {
        try {
            $subject = Subject::create($request->validated());
    
            return response()->json([
                'success' => true,
                'message' => 'Subject added successfully!',
                'subject' => $subject // Send back the created subject if needed
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
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
        
    }

   
    public function update(UpdateSubjectRequest $request, $id)
    {
        $subject = Subject::find($id);
    
        if (!$subject) {
            return response()->json(['error' => 'Subject not found!'], 404);
        }
    
        $subject->update($request->validated());
    
        return response()->json([
            'message' => 'Subject updated successfully!',
            'subject' => $subject
        ]);
    }
    

   
    public function destroy($id)
    {

        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }
    
        try {
            $subject->delete();
            \Log::info('Successfully deleted1'); // Debugging
            return response()->json([
                'message' => 'Subject deleted successfully!',
                'subject' => new SubjectController($subject) 
            ]);

            
        } catch (\Exception $e) {
            \Log::error('Cannot delete subject: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong during deletion.'], 500);
        }
    }
    
}
