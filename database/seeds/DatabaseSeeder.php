<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role = App\Role::create([
            'name' => 'admin',
            'access' => ["pages"],
            'description' => 'Administrator'
        ]);

        App\Role::create([
            'name' => 'editor',
            'access' => ["pages", "articles"],
            'description' => 'Content Editor'
        ]);

        \App\User::create([
            'username' => 'admin',
            'role_id' => $role->id,
            'name' => 'Admin Sadmin',
            'email' => 'admin@cdi.com',
            'email_verified_at' => now(),
            'password' => Hash::make('6.62607004')
        ]);

        // factory(App\User::class, 99)->create();
    }
}
