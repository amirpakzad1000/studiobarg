<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Databases\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{

    public static $seeders = [];
    public function run(): void
    {
        foreach (self::$seeders as $seeder) {
            $this->call($seeder);
        }

      /* User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
