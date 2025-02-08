<?php

namespace studiobarg\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use studiobarg\User\Models\User;
use studiobarg\User\Services\VerifyCodeService;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_see_register(): void
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    public function test_user_can_register(): void
    {

        $response = $this->post(route('register'), [
            '_token' => csrf_token(),
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
        $userData = [
            '_token' => csrf_token(),
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'mobile' => '9129123456',
            'password' => 'Love@song1984',
            'password_confirmation' => 'Love@song1984',
        ];

        // ارسال درخواست ثبت‌نام
        $response = $this->post(route('register'), $userData);

        // جستجو برای کاربری که ایمیل مشابه داده شده دارد
        $user = User::where('email', $userData['email'])->first();
        $this->actingAs($user);

        // بررسی ریدایرکت به صفحه تایید ایمیل
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_user_can_verify_account()
    {
        // ایجاد یک کاربر واقعی در دیتابیس تست
        $user = User::factory()->create([
            'email' => 'john@doe.com',
            'mobile' => '9129123456',
            'password' => bcrypt('Love@song1984'),
        ]);

        // تولید کد تأیید
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id, $code,now()->addDay());
        // ورود کاربر
        auth()->loginUsingId($user->id);
        $this->assertAuthenticated();

        // ارسال درخواست تأیید حساب
        $response = $this->post(route('verification.verify'), [
            'verify_code' => $code,
        ]);

        // رفرش کاربر از دیتابیس
        $user->refresh();

        // بررسی تأیید شدن ایمیل
        $this->assertTrue($user->hasVerifiedEmail());
    }

    public function test_verified_user_can_see_dashboard()
    {
        $userData = [
            '_token' => csrf_token(),
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'mobile' => '9129123456',
            'password' => 'Love@song1984',
            'password_confirmation' => 'Love@song1984',
        ];
        // ارسال درخواست ثبت‌نام
        $this->post(route('register'), $userData);

        // جستجو برای کاربر تازه ثبت‌شده
        $user = User::where('email', $userData['email'])->first();

        // تأیید ایمیل
        $user->markEmailAsVerified();

        // شبیه‌سازی ورود به سیستم
        $this->actingAs($user);

        // بررسی دسترسی به داشبورد
        $response = $this->get(route('dashboard'));
        $response->assertOk();
    }

    protected function setUp(): void
    {
        parent::setUp();
        // پاک‌سازی دیتابیس و اعمال مهاجرت‌ها
        $this->artisan('migrate');

        // غیرفعال کردن Middleware مربوط به CSRF
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
    }
}
