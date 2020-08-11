<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use function PHPSTORM_META\map;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null, $role = null)
    {
        $user = $user ?: factory('App\User')->create();

        $this->actingAs($user);

        return $user;
    }

    /**
     * @param string $role either admin or editor
     *
     * @return mixed
     */
    protected function signInAs(string $role)
    {
        $roles = ['admin', 'editor'];

        // outputs index or key of chosen value from array.
        $role_id = (array_search($role, $roles) + 1);

        $user = factory('App\User')->create(['role_id' => $role_id]);

        $this->actingAs($user);

        return $user;
    }
}
