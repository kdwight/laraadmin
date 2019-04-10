<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->name,
        'password' => '$2y$10$3rsC0huV31ZsMn2rHb8CFOjBWglWRS1mIuajeQ3NcxWNSRWFjSKj6', // 123
        'type' => 'editor',
        'created_by' => 1,
        'remember_token' => str_random(10),
    ];
});
