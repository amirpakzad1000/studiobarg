<?php

namespace studiobarg\Course\Repositories;

use Illuminate\Support\Str;
use studiobarg\Course\Models\Course;

class CourseRepo
{
    public function store($value)
    {
        return Course::create([
            'category_id' => $value->category_id,
            'teacher_id' => $value->teacher_id,
            'title' => $value->title,
            'slug' => Str::slug($value->slug),
            'price' => $value->price,
            'percent' => $value->percent,
            'priority' => $value->priority,
            'type' => $value->type,
            'status' => $value->status,
            'description' => $value->description,
        ]);

    }
}
