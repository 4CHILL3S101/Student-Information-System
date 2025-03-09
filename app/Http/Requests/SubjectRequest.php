<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'name'=> 'required|string|max:255|unique:subjects,name',
            'units'=> 'required|string|max:255',
            'code'=> 'required|string|max:255'
        ];
    }

    public function messages():array{
        return [
            'name.required'  => 'The subject name is required.',
            'name.unique'    => 'This subject already exists.',
            'name.max'       => 'The subject name should not exceed 255 characters.',
            'units.required' => 'The number of units is required.',
            'units.max'      => 'The number of units should not exceed 255 characters.',
            'code.required'  => 'The subject code is required.',
            'code.max'       => 'The subject code should not exceed 255 characters.',
        ];
    }

}
