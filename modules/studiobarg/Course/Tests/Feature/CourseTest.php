<?php

namespace studiobarg\Course\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use studiobarg\Course\Databases\Seeder\RolePermissionTableSeeder;
use studiobarg\Course\Models\Course;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Models\User;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use withFaker;
    use RefreshDatabase;

    // permitted user can see courses index
    public function test_permitted_user_can_see_course_index()
    {
        $this->actAsAdmin();
        $this->get(route('courses.index'))->assertStatus(200);

        $this->actAsSuprAdmin();
        $this->get(route('courses.index'))->assertStatus(200);
    }

        public function test_permitted_user_can_not_see_course_index()
    {
        $this->actAsUser();
        $this->get(route('courses.index'))->assertStatus(403);
    }//End Method


    //permitted user can creat course

public function test_user_can_create_course()
    {
        $this->actAsAdmin();
        $this->get(route('courses.create'))->assertStatus(200);

        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.create'))->assertOk();
    } //End Method

    public function test_user_can_not_create_course()
    {
        $this->actAsUser();
        $this->get(route('courses.create'))->assertStatus(403);
    }

    //permitted user can edit course
    public function test_permitted_user_can_edit_user()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->get(route('courses.edit', $course->id))->assertStatus(200);

        $this->actAsUser();
        $course = $this->createCourse();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.edit', $course->id))->assertOk();
    }//End Method

    public function test_user_can_not_edit_course()
    {
        $this->actAsUser();
        $this->createCourse();
        $this->get(route('courses.create'))->assertStatus(403);
    }

    public function test_user_can_not_edit_other_post_users()
    {
        $this->actAsUser();
        $course = $this->createCourse();

        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.edit',$course->id))->assertStatus(403);
    }





    //permitted user can delete course

    //permitted user can accept course
    //permitted user can lock course
    //permitted user can reject course






    private function actAsAdmin()
    {
        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }
    private function actAsUser()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(rolePermissionTableSeeder::class);
    }

    private function actAsSuprAdmin()
    {
        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }//End Method


    private function createCourse()
    {
        $courses = Course::create([
            'title' => $this->faker->word,
            'slug' => $this->faker->word,
            'teacher_id' => auth()->id(),
            'priority' => 12,
            'percent' => 70,
            'price' => 250000,
            'type' => Course::TAPE_FREE,
            'status' => Course::STATUS_COMPLETED,
            'confirmationStatus' => Course::CONFIRMATION_STATUS_REJECTED,
        ]);
        return $courses;
    }
}
