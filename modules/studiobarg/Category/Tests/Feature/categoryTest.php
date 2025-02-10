<?php

namespace studiobarg\Category\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use studiobarg\Category\Models\Category;
use studiobarg\User\Models\User;
use Tests\TestCase;

class categoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_authenticated_user_can_see_categories_panel(): void
    {
        //todo add permission
        $this->actionAdminAs();
        $this->assertAuthenticated();
        $this->get(route('categories.index'))->assertOk();
    }//End Method

        private function actionAdminAs()
    {
        $this->actingAs(User::factory()->create());
    }//End Method

    public function test_user_can_create_category(): void
    {
        $this->actionAdminAs();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
    }//End Method

    public function test_user_can_update_category(): void
    {
        $newTitle = "dfgdgfdgfdg";
        $this->actionAdminAs();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->patch(route('categories.update', 1), ['title' => $newTitle, 'slug' => $this->faker()->word,
        ]);
        $this->assertEquals(1, Category::whereTitle($newTitle)->count());
    }//End Method

public function test_user_delete__category_item(): void
    {
        $this->actionAdminAs();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->delete(route('categories.destroy', 1))->assertOk();
    }

    private function createCategory()
    {
        $this->post(route('categories.store'), [
            'title' => $this->faker()->word,
            'slug' => $this->faker()->word,
        ]);
    }
}
