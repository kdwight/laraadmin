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
        \App\User::create([
            'username' => 'admin',
            'password' => bcrypt('6.62607004'),
            'type' => 'admin',
            'created_by' => 1
        ]);

        \App\Role::create([
            'name' => 'admin',
            'access' => '["dashboard","pages","users"]',
            'description' => 'Administrator'
        ]);
        \App\Role::create([
            'name' => 'editor',
            'access' => '["dashboard","pages"]',
            'description' => 'Content Editor'
        ]);

        $users = factory(App\User::class, 10)->create();
    }
}
