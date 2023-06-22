<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BugRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'category_id' => 'required|exists:bug_categories,id',
            'status_id' => 'required|exists:status,id',
            'priority_id' => 'required|exists:priority,id',
            'title' => 'required',
            'description' => 'required',
            'reporter_by' => 'required|exists:users,id',
            'assigned_to' => 'required|exists:users,id',
        ];
    }
}
