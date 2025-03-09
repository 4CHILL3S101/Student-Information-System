<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
        $subjectId = $this->route('id'); // Get the subject ID from the route
    
        return [
            'name' => 'required|string|max:255|' . $subjectId,
            'units' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ];
    }
    

    public function message(){
        return[
            'name.required' => 'The subject name is required.',
            'name.unique' => 'This subject name already exists.',
            'units.required' => 'The total units field is required.',
            'code.required' => 'The subject code is required.',
        ];
    }
}
