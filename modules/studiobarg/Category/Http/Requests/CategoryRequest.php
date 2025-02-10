<?php

namespace studiobarg\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends formRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check()==true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|unique:categories|max:190',
            'slug'=>'required|unique:categories|max:190',
            'parent_id'=>'nullable|exists:categories,id',
        ];
    }
}
