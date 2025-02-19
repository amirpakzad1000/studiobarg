<?php

namespace studiobarg\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
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
    public function test_user_can_see_reset_request_form(): void
    {
        $this->get(route('password.request'))->assertStatus(200);;
    }

    public function test_verify_code_can_see_form_by_correct_email()
    {

        $this->call('get', route('password.sendVerifyCodeEmail'), ['email' => 'amir@gmail.com'])->assertOk();
    }

    public function test_verify_code_cannot_see_form_by_wrong_email()
    {
        $this->call('get', route('password.sendVerifyCodeEmail'), ['email' => 'amirgmail.com'])->assertStatus(302);
    }

    public function test_user_banned_after_6_attempts_to_reset_password()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'amir@gmail.com'])->assertStatus(302);
        }
        $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'amir@gmail.com'])->assertStatus(429);

    }
}
