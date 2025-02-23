<?php

namespace studiobarg\Category\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use studiobarg\Category\Models\Category;
use studiobarg\RolePermission\Databases\Seeder\RolePermissionTableSeeder;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Models\User;
use Tests\TestCase;

class categoryTest extends TestCase
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
    public function test_manage_categories_panel_permission_holder_can_see_categories_panel(): void
    {
        $this->actAdminAs();
        $this->get(route('categories.index'))->assertOk();
    } //End Method

    public function test_normal_user_can_not_see_categories_panel(): void
    {
        $this->actUserAs();
        $this->get(route('categories.index'))->assertStatus(403);
    } //End Method


    public function test_user_Permitted_can_create_category(): void
    {
        $this->actAdminAs();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
    }//End Method

    public function test_user_can_update_category(): void
    {
        $newTitle = "dfgdgfdgfffffffdg";
        $this->actAdminAs();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->patch(route('categories.update', 1), ['title' => $newTitle, 'slug' => $this->faker()->word,
        ]);
        $this->assertEquals(1, Category::whereTitle($newTitle)->count());
    }//End Method

public function test_user_delete_category_item(): void
    {
        $this->actAdminAs();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->delete(route('categories.destroy', 1))->assertOk();
    }

    private function actAdminAs()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(rolePermissionTableSeeder::class);
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }//End Method
    private function actUserAs()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(rolePermissionTableSeeder::class);
    }//End Method

    private function createCategory()
    {
        $this->post(route('categories.store'), [
            'title' => $this->faker()->word,
            'slug' => $this->faker()->word,
        ]);
    }
}
