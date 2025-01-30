<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use studiobarg\User\Models\User;
use Tests\TestCase;

class RegisterationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_see_register(): void
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    public function test_user_can_register(): void
    {
        $response = $this->withoutMiddleware()->post(route('register'), [
           'name' => 'John Doe',
           'email' => 'john@doe.com',
           'mobile' => '+989123456785',
           'password' => 'Love@song1984',
           'password_confirmation' => 'Love@song1984',
        ]);
        $response->assertRedirect(route('verification.notice'));
        $this->assertCount(1,User::all());
    }

    public function test_user_redirected_to_verify_email_after_registration()
    {
        $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'mobile' => '+989123456785',
            'password' => 'Love@song1984',
            'password_confirmation' => 'Love@song1984',
        ]);

        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('verification.notice'));
    }
}
