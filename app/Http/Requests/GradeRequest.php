<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
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
            'grades' => 'required|array',
            'grades.*' => 'numeric|min:0|max:100', 
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'The student ID is required.',
            'student_id.exists' => 'The provided student ID does not exist.',
            'grades.required' => 'Grades are required.',
            'grades.array' => 'Grades must be an array.',
            'grades.*.numeric' => 'Each grade must be a numeric value.',
            'grades.*.min' => 'Grades cannot be less than 0.',
            'grades.*.max' => 'Grades cannot be more than 100.',
        ];
    }




}
