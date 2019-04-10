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
        $pages = factory(App\Page::class, 10)->create();

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
