<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\UserSetup;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function it_belongs_to_a_role()
    {
        $user = UserSetup::create();

        $this->assertInstanceOf('App\Role', $user->role);
    }

    /** @test */
    function a_user_has_role_of_admin()
    {
        $user = UserSetup::admin()->create();
        $this->assertTrue($user->IsAdmin());
    }
}
