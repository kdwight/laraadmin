<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\UserSetup;
use Tests\TestCase;

class ManageUsersTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function non_admin_cannot_manage_users()
    {
        $user = UserSetup::create();

        $this->actingAs($user)->get('/admin/users')->assertStatus(403);
    }

    /** @test */
    function admin_can_create_another_user()
    {
        $user = $this->signInAs('admin');

        $user = $this->post('/admin/users', $attr = [
            'role_id' => Role::get()->last()->id,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'letmein'
        ])->assertStatus(200);
        unset($attr['password']);

        $this->assertDatabaseHas('users', $attr);
        $this->assertDatabaseCount('users', 2);
    }

    public function test_an_admin_can_update_a_user()
    {
        $user = $this->signInAs('admin');
        $dummyUser = UserSetup::create();

        $this->put($dummyUser->path(), $attr = [
            'role_id' => 2,
            'name' => 'Changed name',
            'email' => 'changed@mail.com',
            'password' => 'asdsdd',
            'password_confirmation' => 'asdsdd',
        ]);
        unset($attr['password']);
        unset($attr['password_confirmation']);

        $this->get($dummyUser->path() . "/edit")->assertOk();

        $this->assertDatabaseHas('users', $attr);
    }

    /** @test */
    function admin_can_change_user_status()
    {
        $admin = $this->signInAs('admin');
        $user = UserSetup::create();

        // deactivate
        $this->put("/admin/users/{$user->id}/status", [
            'status' => false
        ])
            ->assertjson(['success' => true])
            ->assertStatus(200);

        $this->assertEquals(User::find($user->id)->status, false);

        // reactivate
        $this->put("/admin/users/{$user->id}/status", [
            'status' => true
        ])->assertStatus(200);

        $this->assertEquals(User::find($user->id)->status, true);
    }

    /** @test */
    public function a_user_requires_valid_email()
    {
        $admin = $this->signInAs('admin');

        $attributes = factory('App\User')->raw(['email' => 'asdasd@mail.']);

        $this->post('/admin/users', $attributes)
            ->assertSessionHasErrors('email');
    }
}
