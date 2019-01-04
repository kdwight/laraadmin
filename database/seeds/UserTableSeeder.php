<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\User();
        $admin->username = 'admin';
        $admin->password = bcrypt('secret');
        $admin->type = 'admin';
        $admin->created_by = 1;
        $admin->save();

        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->access = '["pages","bookings","inquiries","articles","services", "users"]';
        $admin->description = 'Administrator';
        $admin->save();

        $editor = new \App\Role();
        $editor->name = 'editor';
        $editor->access = '["pages","articles"]';
        $editor->description = 'Content Editor';
        $editor->save();

        $users = factory(App\User::class, 10)->create();
    }
}
