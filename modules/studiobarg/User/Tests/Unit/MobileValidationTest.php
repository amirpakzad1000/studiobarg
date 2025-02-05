<?php
namespace studiobarg\User\Tests\Unit;

use Illuminate\Support\Facades\App;
use PHPUnit\Framework\TestCase;
use studiobarg\User\Rules\validMobile;


class MobileValidationTest extends TestCase
{

    public function test_valid_mobile_number_passes()
    {
        $rule = new validMobile();

        $this->assertNull(
            $rule->validate('mobile', '9123456789', function ($message) {
                $this->fail("Validation failed: $message");
            })
        );
    }

    public function test_invalid_mobile_number_fails()
    {
        $rule = new validMobile();

        $this->expectException(\Exception::class);

        $rule->validate('mobile', '8123456789', function ($message) {
            throw new \Exception($message);
        });
    }

    public function test_too_short_mobile_number_fails()
    {
        $rule = new validMobile();

        $this->expectException(\Exception::class);

        $rule->validate('mobile', '91234', function ($message) {
            throw new \Exception($message);
        });
    }

    public function test_mobile_number_with_letters_fails()
    {
        $rule = new validMobile();

        $this->expectException(\Exception::class);

        $rule->validate('mobile', '91a3456789', function ($message) {
            throw new \Exception($message);
        });
    }
}
