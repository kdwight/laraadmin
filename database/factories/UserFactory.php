<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

Role::create([
    'name' => 'admin',
    'modules' => [
        [
            'name' => "articles",
            'path' => "/admin/articles",
            'icon' => "mdi-format-float-left",
        ],
        [
            'name' => "pages",
            'path' => "/admin/pages",
            'icon' => "mdi-newspaper-variant-multiple",
        ],
    ],
    'description' => 'Admin'
]);

Role::create([
    'name' => 'editor',
    'modules' => [
        [
            'name' => "pages",
            'path' => "/admin/pages",
            'icon' => "mdi-newspaper-variant-multiple",
        ],
    ],
    'description' => 'Content Editor'
]);

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
