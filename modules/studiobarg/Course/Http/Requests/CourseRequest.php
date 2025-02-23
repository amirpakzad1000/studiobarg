<?php

namespace studiobarg\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use studiobarg\Course\Models\Course;
use studiobarg\Course\Rules\ValidTeacher;


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
            'title' => 'required|min:3|max:190',
            'slug' => 'required|min:3|max:190|unique:courses,slug',
            'priority' => 'required|integer',
            'price' => 'required|numeric',
            'percent' => 'required|numeric',
            'tags' => 'nullable|string',
            'teacher_id' => ['sometimes', 'exists:users,id', new ValidTeacher()],
            'type' => ['required', Rule::in(Course::$types)],
            'status' => ['required', Rule::in(Course::$statuses)],
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',

        ];
        if (request()->isMethod('PATCH')) {
            $rules['slug'] = [
                'required',
                'min:3',
                'max:190',
                Rule::unique('courses', 'slug')->ignore($courseId),
            ];
        }
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
