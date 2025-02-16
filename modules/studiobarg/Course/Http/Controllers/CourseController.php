<?php

namespace studiobarg\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use studiobarg\Category\Repository\categoryRepo;
use studiobarg\Category\Responses\AjaxResponse;
use studiobarg\Course\Http\Requests\CourseRequest;
use studiobarg\Course\Models\Course;
use studiobarg\Course\Repositories\CourseRepo;
use studiobarg\User\Repositories\UserRepo;

class CourseController extends Controller
{

    public function index(CourseRepo $courseRepo)
    {
        $courses = $courseRepo->paginate();
        return view('Courses::index', compact('courses'));
    }//End method


    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $teachers = $userRepo->getTeacher();
        $categories = $categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }//End method


    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->store($request);

        if ($request->hasFile('banner_id')) {
            // افزودن تصویر اصلی به کالکشن 'images'
            $course->addMedia($request->file('banner_id'))
                ->toMediaCollection('images');

            // اطمینان از اینکه تصاویر مختلف به درستی ایجاد شده‌اند
            $course->refreshMedia(); // این اطمینان می‌دهد که نسخه‌های تبدیل‌شده به درستی بارگذاری شوند

            // دریافت نسخه‌های مختلف تصویر
            $thumbUrl = $course->getFirstMediaUrl('images', 'thumb');
            $previewUrl = $course->getFirstMediaUrl('images', 'preview');
        }

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    } //End method


    public function edit($id, CourseRepo $courseRepo, CategoryRepo $categoryRepo, UserRepo $userRepo)
    {
        $course = $courseRepo->fingById($id);
        $categories = $categoryRepo->all();
        $teachers = $userRepo->getTeacher();

        return view('Courses::edit', compact('course', 'categories', 'teachers'));
    } //End method


    public function update($id, CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->fingById($id);
        // بررسی اینکه آیا تصویر جدیدی ارسال شده است یا خیر
        // بررسی اینکه آیا تصویر جدیدی ارسال شده است یا خیر
        if ($request->hasFile('banner_id')) {
            // بررسی صحت فایل بارگذاری شده
            if ($request->file('banner_id')->isValid()) {
                // حذف تصویر قبلی از کالکشن 'images'
                $course->clearMediaCollection('images');

                // افزودن تصویر جدید به کالکشن 'images'
                $course->addMedia($request->file('banner_id'))
                    ->toMediaCollection('images');

                // دریافت نسخه‌های مختلف تصویر
                $thumbUrl = $course->getFirstMediaUrl('images', 'thumb');
                $previewUrl = $course->getFirstMediaUrl('images', 'preview');
            } else {
                return back()->withErrors(['banner_id' => 'The uploaded file is invalid or not found']);
            }
        }
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    } //End method

    public function destroy($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->fingById($id);
        $course->clearMediaCollection('images');
        $course->delete();
        return AjaxResponse::successResponse();
    } //End method

    public function accept($id, CourseRepo $courseRepo)
    {

        if ( $courseRepo->updateConfirmationStatus($id,Course::CONFIRMATION_STATUS_REJECTED)){
            return AjaxResponse::successResponse();
        }else
        {
            return AjaxResponse::errorResponse();
        }
    }

    public function reject($id, CourseRepo $courseRepo)
    {

        if ( $courseRepo->updateConfirmationStatus($id,Course::CONFIRMATION_STATUS_ACCEPTED)){
            return AjaxResponse::successResponse();
        }else
        {
            return AjaxResponse::errorResponse();
        }
    }

    public function lock($id, CourseRepo $courseRepo)
    {

        if ( $courseRepo->updateStatus($id,Course::STATUS_LOCKED)){
            return AjaxResponse::successResponse();
        }else
        {
            return AjaxResponse::errorResponse();
        }
    }
}
