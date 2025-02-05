<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase; // استفاده از Trait برای مقداردهی دیتابیس

    protected function setUp(): void
    {
        parent::setUp();

        // اطمینان از استفاده از دیتابیس تست
        config(['database.default' => 'sqlite']);
        config(['database.connections.sqlite.database' => ':memory:']);

        // اجرای مهاجرت‌ها برای دیتابیس تست
        $this->artisan('migrate');
    }
}
