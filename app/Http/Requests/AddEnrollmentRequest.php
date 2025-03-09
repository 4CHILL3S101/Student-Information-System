<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEnrollmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:users,id',
            'course_name' => 'required',
            'semester' => 'required',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'exists:subjects,id', 
        ];
    }



    public function isStudentExisting(){
        
    }

    public function messages()
    {
        return [
            'student_id.required' => 'The student ID is required.',
            'student_id.exists' => 'The selected student does not exist.',
            'course_name.required' => 'The course name is required.',
            'semester.required' => 'The semester is required.',
            'subjects.required' => 'At least one subject must be selected.',
            'subjects.*.exists' => 'One or more selected subjects are invalid.',
        ];
    }
}
