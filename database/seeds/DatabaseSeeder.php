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
        $admin = new \App\User();
        $admin->username = 'admin';
        $admin->password = bcrypt('secret');
        $admin->type = 'admin';
        $admin->created_by = 1;
        $admin->save();

        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->access = '["pages","users"]';
        $admin->description = 'administrator';
        $admin->save();

        $editor = new \App\Role();
        $editor->name = 'editor';
        $editor->access = '["pages"]';
        $editor->description = 'content editor';
        $editor->save();

        $users = factory(App\User::class, 10)->create();
        $pages = factory(App\Page::class, 10)->create();
    }
}
