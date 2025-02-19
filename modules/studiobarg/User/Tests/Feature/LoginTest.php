<?php

namespace studiobarg\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use studiobarg\User\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite']);
        config(['database.connections.sqlite.database' => ':memory:']);

        $this->artisan('migrate');

        // غیرفعال کردن CSRF Middleware
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
    }

    public function test_user_can_login_with_email(): void
    {
        // ساخت یک کاربر با استفاده از فاکتوری
        $user = User::factory()->create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('Love@song1984'),  // پسورد هش‌شده
        ]);

        // ارسال درخواست لاگین با استفاده از ایمیل و پسورد
         $this->actingAs($user)->post(route('login'), [
            'X-CSRF-TOKEN' => csrf_token(),
            'email' => $user->email,
            'password' => 'Love@song1984',
        ]);

        // بررسی اینکه کاربر به درستی احراز هویت شده است
        $this->assertAuthenticated(); // بررسی احراز هویت با این کاربر
    }

    public function test_user_can_login_with_mobile(): void
    {
        // ساخت یک کاربر با استفاده از فاکتوری
        $user = User::factory()->create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'mobile' => '9124562132', // موبایل کاربر
            'password' => bcrypt('Love@song1984'),  // پسورد هش‌شده
        ]);

        // ارسال درخواست لاگین با استفاده از موبایل و پسورد
        $this->actingAs($user)->post(route('login'), [
            'email' => $user->mobile, // اگر از موبایل برای لاگین استفاده می‌شود، فیلد باید موبایل باشد
            'password' => 'Love@song1984',
        ]);

        $this->assertAuthenticated(); // بررسی احراز هویت با این کاربر
    }

}
