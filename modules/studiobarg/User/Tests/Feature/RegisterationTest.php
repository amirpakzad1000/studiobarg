<?php

namespace studiobarg\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use studiobarg\User\Models\User;
use Tests\TestCase;

class RegisterationTest extends TestCase
{
    use RefreshDatabase;


    public function test_user_see_register(): void
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    public function test_user_can_register(): void
    {
        $response = $this->postJson(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'mobile' => '9129123456',
            'password' => 'Love@song1984',
            'password_confirmation' => 'Love@song1984',
        ]);

        $response->assertRedirect(route('verification.notice'));

        // بررسی اینکه کاربر در دیتابیس ذخیره شده است
        $this->assertDatabaseHas('users', ['email' => 'john@doe.com']);
    }


    public function test_user_redirected_to_verify_email_after_registration()
    {
        $response = $this->post(route('register'), [
              'name' => 'John Doe',
              'email' => 'john@doe.com',
              'mobile' => '9129123456',
              'password' => 'Love@song1984',
              'password_confirmation' => 'Love@song1984',
          ]);
        $user = User::where('email', 'test@example.com')->first();
        $this->actingAs($user);
        // پس از ثبت‌نام، باید به صفحه تایید ایمیل ریدایرکت شود نه به dashboard
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_verify_user_can_see_dashboard()
    {
        $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'mobile' => '9129123456',
            'password' => 'Love@song1984',
            'password_confirmation' => 'Love@song1984',
        ]);

        $this->assertAuthenticated();
        auth()->user()->markEmailAsVerified();
        $response = $this->get(route('dashboard'));
        $response->assertOk();

    }
}
