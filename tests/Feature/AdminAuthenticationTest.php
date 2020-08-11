<?php

namespace Tests\Feature;

use Facades\Tests\Setup\UserSetup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_view_a_login_form()
    {
        $response = $this->get('/admin');

        $response->assertSuccessful();
        $response->assertViewIs('admin.index');
    }

    /** @test */
    function a_user_can_login_to_admin_panel()
    {
        $user = UserSetup::create();

        $attributes = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->post("/admin/login", $attributes)
            ->assertRedirect('/admin/dashboard');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    function a_deactivated_user_cannot_login()
    {
        $user = UserSetup::deactivated()->create();

        $attributes = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->post("/admin/login", $attributes)
            ->assertSessionHas("login-error");

        $this->assertGuest();
    }
}
