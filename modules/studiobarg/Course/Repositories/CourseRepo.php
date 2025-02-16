<?php

namespace studiobarg\Course\Repositories;

use Illuminate\Support\Str;
use studiobarg\Course\Models\Course;

class CourseRepo
{
    public function paginate()
    {
        return Course::query()->paginate(10);
    }

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

    public function fingById($id)
    {
        return Course::query()->findOrFail($id);
    }

    public function update($id, $value)
    {
        return Course::where('id',$id)->update([
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

    public function updateConfirmationStatus($id, string $status)
    {
        return Course::query()->where('id', $id)->update(['confirmation_status' => $status]);
    }

    public function updateStatus($id, $status)
    {
        return Course::query()->where('id', $id)->update(['status' => $status]);
    }

}
