<?php

namespace studiobarg\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CourseRequest extends FormRequest
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
        $courseId = request()->route('course');

        $rules = [
            'title' => 'required|string',
            'slug' => 'required|string|min:3|max:100|unique:courses,slug,'. $courseId,
            'priority' => 'required|integer',
            'price' => 'required|numeric',
            'percent' => 'required|numeric',
            'tags' => 'nullable|string',
            'teacher_id' => 'required',
            'type' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'banner_id' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240'
        ];
        return $rules;
    }

    public function attributes(): array
    {
        return [
            "title" => "عنوان",
            "slug" => "عنوان انگلیسی",
            "priority" => "ردیف دوره",
            "price" => "قیمت",
            "percent" => "درصد مدرس",
            "teacher_id" => "مدرس دوره",
            "type" => "نوع دوره",
            "status" => "وضعیت دوره",
            "category_id" => "دسته بندی",
            "image" => "بنر دوره",
        ];
    }

    public function messages(): array
    {
        return [
            // 'price.min'=>trans('Courses::Validations.price_min'),
        ];
    }
}
