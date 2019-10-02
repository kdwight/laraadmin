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
            'name' => 'Admin Admin',
            'email' => 'admin@cdi.com',
            'email_verified_at' => now(),
            'password' => Hash::make('6.62607004'),
            'role' => 'admin',
            'created_by' => 1
        ]);
    }
}
