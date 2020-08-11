<?php

namespace Tests\Setup;

use App\User;

class UserSetup
{
    protected $status;
    protected $role;

    public function admin()
    {
        $this->role = 1;

        return $this;
    }

    public function editor()
    {
        $this->role = 2;

        return $this;
    }

    public function deactivated()
    {
        $this->status = false;

        return $this;
    }

    public function create()
    {
        $user = factory(User::class)->create([
            'role_id' => $this->role ?? factory('App\Role')->create(),
            'status' => $this->status ?? true
        ]);

        return $user;
    }
}
