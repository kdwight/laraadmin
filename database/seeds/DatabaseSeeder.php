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
        // $this->call(UserSeeder::class);
        factory('App\User')->create([
            'role_id' => 1,
            'email' => 'bonak@mail.com'
        ]);
    }
}
