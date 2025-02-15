<?php

namespace studiobarg\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use studiobarg\Category\Repository\categoryRepo;
use studiobarg\Course\Http\Requests\CourseRequest;
use studiobarg\Course\Repositories\CourseRepo;
use studiobarg\Media\Services\MediaUploadService;
use studiobarg\User\Repositories\UserRepo;

class CourseController extends Controller
{

    public function index()
    {
        return "courses";
    }


    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $teachers = $userRepo->getTeacher();
        $categories = $categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }


    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->store($request);

        if ($request->hasFile('banner_id')) {
            $course->addMedia($request->file('banner_id'))
                ->toMediaCollection('images'); // مجموعه رسانه‌ای 'images'
        }
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
