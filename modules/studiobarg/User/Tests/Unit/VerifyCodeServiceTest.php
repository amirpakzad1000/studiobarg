<?php
namespace studiobarg\User\Tests\Unit;

use studiobarg\User\Services\VerifyCodeService;
use Tests\TestCase;

class VerifyCodeServiceTest extends TestCase
{
    public function test_generate_code_less_6_digit()
    {
        $code = VerifyCodeService::generate();
        $this->assertIsNumeric($code, 'Generate Code is Not Numeric');
        $this->assertLessThanOrEqual(999999, $code, "Generate Code is less than 999999");
        $this->assertGreaterThanOrEqual(100000, $code, "Generate Code is less than 1000000");
    }

    public function test_verify_code_can_store()
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1, $code,120);
        $this->assertEquals($code, cache()->get('verify_code_1'));
    }
}
