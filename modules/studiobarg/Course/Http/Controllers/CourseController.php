<?php

namespace studiobarg\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use studiobarg\Category\Repository\categoryRepo;
use studiobarg\Common\Responses\AjaxResponses;
use studiobarg\Course\Http\Requests\CourseRequest;
use studiobarg\Course\Models\Course;
use studiobarg\Course\Repositories\CourseRepo;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Repositories\UserRepo;

class CourseController extends Controller
{
    use AuthorizesRequests;

    public function index(CourseRepo $courseRepo)
    {
        $this->authorize('index', Course::class);
        $courses = $courseRepo->paginate();
        return view('Courses::index', compact('courses'));
    } //End method


    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $this->authorize('create', Course::class);
        $teachers = $userRepo->getTeacher();
        $categories = $categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }//End method


    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $this->authorize('create', Course::class);

        // بررسی مجوز کاربر برای مدیریت دوره‌ها
        $teacherId = $request->input('teacher_id', auth()->id());
        if (!auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            $teacherId = auth()->id();
        }

        // ذخیره دوره
        $course = $courseRepo->store($request->merge([
            'teacher_id' => $teacherId,
        ]));

        // افزودن تصویر بنر در صورت ارسال آن
        if ($request->hasFile('banner_id')) {
            $course->addMedia($request->file('banner_id'))
                ->toMediaCollection('images');

            // دریافت نسخه‌های مختلف تصویر
            $thumbUrl = $course->getFirstMediaUrl('images', 'thumb');
            $previewUrl = $course->getFirstMediaUrl('images', 'preview');
        }

        // هدایت به صفحه دوره‌ها با پیام موفقیت
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }  //End method


    public function edit($id, CourseRepo $courseRepo, CategoryRepo $categoryRepo, UserRepo $userRepo)
    {
        $course = $courseRepo->findById($id);
        $this->authorize('edit', $course);
        $categories = $categoryRepo->all();
        $teachers = $userRepo->getTeacher();

        return view('Courses::edit', compact('course', 'categories', 'teachers'));
    } //End method


    public function update($id, CourseRequest $request, CourseRepo $courseRepo)
    {

        $course = $courseRepo->findById($id);
        $this->authorize('edit', $course);
        if ($request->hasFile('banner_id')) {

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
        $courseRepo->update($id, $request);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    } //End method

    public function destroy($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findById($id);
        $this->authorize('delete', $course);
        $course->clearMediaCollection('images');
        $course->delete();
        return AjaxResponses::successResponse();
    } //End method

    public function accept($id, CourseRepo $courseRepo)
    {

        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_REJECTED)) {
            return AjaxResponses::successResponse();
        } else {
            return AjaxResponses::errorResponse();
        }
    }

    public function reject($id, CourseRepo $courseRepo)
    {

        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_ACCEPTED)) {
            return AjaxResponses::successResponse();
        } else {
            return AjaxResponses::errorResponse();
        }
    }

    public function lock($id, CourseRepo $courseRepo)
    {

        if ($courseRepo->updateStatus($id, Course::STATUS_LOCKED)) {
            return AjaxResponses::successResponse();
        } else {
            return AjaxResponses::errorResponse();
        }
    }
}
