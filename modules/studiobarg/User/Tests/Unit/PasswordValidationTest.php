<?php

namespace studiobarg\User\Tests\Unit;

use PHPUnit\Framework\TestCase;
use studiobarg\User\Rules\validPassword;

class PasswordValidationTest extends TestCase
{
    /**
     * تست رمز عبور معتبر
     */
    public function test_valid_password_passes()
    {
        $rule = new validPassword();

        $this->assertNull(
            $rule->validate('password', 'Aa1@strong', function ($message) {
                $this->fail("Validation failed: $message");
            })
        );
    }

    /**
     * تست رمز عبور کوتاه‌تر از ۸ کاراکتر (رد شود)
     */
    public function test_password_too_short_fails()
    {
        $rule = new validPassword();

        $this->expectException(\Exception::class);

        $rule->validate('password', 'Aa1@', function ($message) {
            throw new \Exception($message);
        });
    }

    /**
     * تست رمز عبور بدون حروف بزرگ (رد شود)
     */
    public function test_password_without_uppercase_fails()
    {
        $rule = new validPassword();

        $this->expectException(\Exception::class);

        $rule->validate('password', 'aa1@strong', function ($message) {
            throw new \Exception($message);
        });
    }

    /**
     * تست رمز عبور بدون حروف کوچک (رد شود)
     */
    public function test_password_without_lowercase_fails()
    {
        $rule = new validPassword();

        $this->expectException(\Exception::class);

        $rule->validate('password', 'AA1@STRONG', function ($message) {
            throw new \Exception($message);
        });
    }

    /**
     * تست رمز عبور بدون عدد (رد شود)
     */
    public function test_password_without_number_fails()
    {
        $rule = new validPassword();

        $this->expectException(\Exception::class);

        $rule->validate('password', 'Aa@strong', function ($message) {
            throw new \Exception($message);
        });
    }

    /**
     * تست رمز عبور بدون کاراکتر خاص (رد شود)
     */
    public function test_password_without_special_character_fails()
    {
        $rule = new validPassword();

        $this->expectException(\Exception::class);

        $rule->validate('password', 'Aa1strong', function ($message) {
            throw new \Exception($message);
        });
    }
}
