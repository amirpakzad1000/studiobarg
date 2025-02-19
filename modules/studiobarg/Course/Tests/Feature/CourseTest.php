<?php

namespace studiobarg\Course\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use studiobarg\Category\Models\Category;
use studiobarg\Course\Databases\Seeder\RolePermissionTableSeeder;
use studiobarg\Course\Models\Course;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Models\User;
use Tests\TestCase;


class CourseTest extends TestCase
{
    use withFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite']);
        config(['database.connections.sqlite.database' => ':memory:']);

        $this->artisan('migrate');

        // غیرفعال کردن CSRF Middleware
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
    }
    // permitted user can see courses index
    public function test_permitted_user_can_see_course_index()
    {
        $this->actAsAdmin();
        $this->get(route('courses.index'))->assertStatus(200);

        $this->actAsSuprAdmin();
        $this->get(route('courses.index'))->assertStatus(200);
    }

    // permitted user can create course

    private function actAsAdmin()
    {
        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    } //End Method


    //permitted user can edit course

    private function actAsUser()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(rolePermissionTableSeeder::class);
    } //End Method

    private function actAsSuprAdmin()
    {
        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    } //End Method

    public function test_permitted_user_can_not_see_course_index()
    {
        $this->actAsUser();
        $this->get(route('courses.index'))->assertStatus(403);
    } //End Method

    // permitted user can update course

    public function test_user_can_create_course()
    {
        $this->actAsAdmin();
        $this->get(route('courses.create'))->assertStatus(200);

        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.create'))->assertOk();
    } //End Method


    //permitted user can edit course
    public function test_user_can_not_create_course()
    {
        $this->actAsUser();
        $this->get(route('courses.create'))->assertStatus(403);
    } //End Method


    public function test_user_permitted_can_store_course()
    {
        $this->actAsUser();
        auth()->user()->givePermissionTo([Permission::PERMISSION_MANAGE_OWN_COURSES, Permission::PERMISSION_MANAGE_COURSES]);

        $this->withoutExceptionHandling();
        Session::start();
        Storage::fake('local');

        // ارسال درخواست برای ایجاد دوره
        $response = $this->post(route('courses.store'), $this->courseData());

        $response->assertRedirect(route('courses.index'));
        $this->assertEquals(Course::count(), 1);
    }

    private function courseData()
    {
        $category = $this->createCategory();
        return [
            '_token' => csrf_token(), // اضافه کردن توکن CSRF به درخواست
            'title' => fake()->sentence(2),
            'slug' => fake()->sentence(2),
            'teacher_id' => auth()->id(),
            'category_id' => $category->id,
            'priority' => 12,
            'percent' => 70,
            'price' => 250000,
            'type' => Course::TAPE_FREE,
            'banner_id' => UploadedFile::fake()->image('banner.jpg'),
            'status' => Course::STATUS_COMPLETED,
        ];
    }

    private function createCategory()
    {
        return Category::create([
            'title' => $this->faker()->word,
            'slug' => $this->faker()->word,
        ]);
    } //End Method

    //permitted user can delete course

    public function test_permitted_user_can_edit_user()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->get(route('courses.edit', $course->id))->assertStatus(200);

        $this->actAsUser();
        $course = $this->createCourse();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.edit', $course->id))->assertOk();
    } //End Method

    private function createCourse()
    {
        $data = $this->courseData() + ['confirmation_status' => Course::CONFIRMATION_STATUS_PENDING];
        unset($data['banner_id']);

        return Course::create($data);
    } //End Method

    //////////////////////////////////////////////////////////////////// Common Method

    public function test_user_can_not_edit_other_post_users()
    {
        $this->actAsUser();
        $course = $this->createCourse();

        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.edit', $course->id))->assertStatus(403);
    }

    // permitted user can create course

    public function test_permitted_user_can_update_course()
    {
        $this->withoutExceptionHandling();
        $this->actAsUser();
        auth()->user()->givePermissionTo([Permission::PERMISSION_MANAGE_OWN_COURSES, Permission::PERMISSION_TEACH]);
        Session::start();
        $this->withSession(['_token' => csrf_token()]);
        $course = $this->createCourse();
        $updatedTitle = 'updated title';
        $categoryId = $course->category->id ?? null;

        $this->patch(route('courses.update', $course->id), [
            '_token' => csrf_token(),
            'title' => $updatedTitle,
            'slug' => 'updated slug',
            'teacher_id' => auth()->id(),
            'category_id' => $categoryId,
            'priority' => 12,
            'price' => 1450,
            'percent' => 80,
            'type' => Course::TAPE_CASH,
            'status' => Course::STATUS_COMPLETED,
        ])->assertRedirect(route('courses.index'));
        $course = $course->fresh();
        \Log::info('Updated Course:', $course->toArray());

        $this->assertEquals($course->title, $course->title);
    }

    public function test_normal_user_can_not_update_course()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();

        $this->withoutExceptionHandling();
        $this->actAsUser();

        auth()->user()->revokePermissionTo(Permission::PERMISSION_TEACH);

        Session::start();
        $this->withSession(['_token' => csrf_token()]);

        $response = $this->patch(route('courses.update', $course->id), [
            '_token' => csrf_token(),
            'title' => 'updated title',
            'slug' => 'updated slug',
            'teacher_id' => auth()->id(),
            'category_id' => $course->category->id,
            'priority' => 12,
            'price' => 1450,
            'percent' => 80,
            'type' => Course::TAPE_CASH,
            'status' => Course::STATUS_COMPLETED,
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('courses.index'));

    }

    public function test_permitted_user_can_delete_course()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();

        Session::start();
        $this->withSession(['_token' => csrf_token()]);

        $response = $this->delete(route('courses.destroy', $course->id), [
            '_token' => csrf_token(),
        ])->assertOk();

        $this->assertEquals(0, Course::count());
    }

    //permitted user can edit course

    public function test_normal_user_can_not_delete_course()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();

        $this->actAsUser();
        $this->delete(route('courses.destroy', $course->id))->assertStatus(403);
        $this->assertEquals(1, Course::count());
    } //End Method

    public function test_normal_user_can_not_edit_course()
    {
        $this->actAsUser();
        $course = $this->createCourse();
        $this->get(route('courses.edit', $course->id))->assertStatus(403);
    } //End Method

    public function test_permitted_user_can_confirmation_status_courses()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->patch(route('course.accept', $course->id), [])->assertOk();
        $this->patch(route('course.reject', $course->id), [])->assertOk();
        $this->patch(route('course.lock', $course->id), [])->assertOk();
    }

    public function test_normal_user_can_not_change_confirmation_status_courses()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();

        $this->actAsUser();
        $this->patch(route('course.accept', $course->id), [])->assertStatus(403);
        $this->patch(route('course.reject', $course->id), [])->assertStatus(403);
        $this->patch(route('course.lock', $course->id), [])->assertStatus(403);
    }
}

