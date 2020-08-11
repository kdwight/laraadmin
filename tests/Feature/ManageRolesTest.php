<?php

namespace Tests\Feature;

use App\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageRolesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    function admin_can_create_a_role()
    {
        $user = $this->signInAs('admin');

        $user = $this->postJson('/admin/roles', $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'modules' => ['abc', 'def', 'ghi']
        ])
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);
    }

    /** @test */
    function admin_can_update_the_role()
    {
        $user = $this->signInAs('admin');

        $role = Role::find(2);

        $this->put("/admin/roles/{$role->id}", $attr = [
            'name' => 'changed-rolename',
            'description' => 'Changed Description',
            'modules' => ['ann', 'yeong']
        ])
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        // because it is json encoded on database so we transform it to this for checking only.
        $attr['modules'] = json_encode($attr['modules']);

        $this->assertDatabaseHas('roles', $attr);
    }
}
