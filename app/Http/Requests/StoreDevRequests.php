<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDevRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'resume_text' => 'required|string|min:50|max:1000',
            'resume_pdf_url' => 'nullable|url',
            'experience' => 'required|integer|min:0|max:50',
            'score' => 'nullable|numeric|between:0,100',
            'request_resume_completed' => 'boolean',
            'request_project_post' => 'boolean',
        ];
    }
}
