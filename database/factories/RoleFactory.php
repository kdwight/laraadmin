<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'modules' => [
            [
                'name' => "foo nak",
                'path' => "/admin/foo",
                'icon' => "mdi-puzzle-edit-outline",
            ],
            [
                'name' => "bar",
                'path' => "/admin/bar",
                'icon' => "mdi-puzzle-edit-outline",
            ],
            [
                'name' => "baz",
                'path' => "/admin/baz",
                'icon' => "mdi-puzzle-edit-outline",
            ],
        ],
        'description' => $faker->sentence,
    ];
});
