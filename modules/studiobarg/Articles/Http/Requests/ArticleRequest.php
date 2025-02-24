<?php

namespace studiobarg\Articles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use studiobarg\Articles\Models\Article;
use studiobarg\Course\Models\Course;
use studiobarg\Course\Rules\ValidTeacher;


class ArticleRequest extends FormRequest
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
        $articleId = request()->route('articles');

        $rules = [
            'title' => 'required|min:3|max:190',
            'slug' => 'required|min:3|max:190|unique:courses,slug',
            'tags' => 'nullable|string',
            'author_id' => ['sometimes', 'exists:users,id'],
            'type' => ['required', Rule::in(Article::$types)],
            'status' => ['required', Rule::in(Article::$statuses)],
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'short_desc' => 'nullable|string',

        ];
        if (request()->isMethod('PATCH')) {
            $rules['slug'] = [
                'required',
                'min:3',
                'max:190',
                Rule::unique('articles', 'slug')->ignore($articleId),
            ];
        }
        return $rules;
    }

    public function attributes(): array
    {
        return [
            "title" => "عنوان",
            "slug" => "عنوان انگلیسی",
            "author_id" => "نویسنده مقاله",
            "type" => "نوع دوره",
            "status" => "وضعیت دوره",
            "category_id" => "دسته بندی",
            "banner_id" => "بنر مقاله",
        ];
    }

    public function messages(): array
    {
        return [
            // 'price.min'=>trans('Courses::Validations.price_min'),
        ];
    }
}
