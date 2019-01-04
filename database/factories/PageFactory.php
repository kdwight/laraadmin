<?php

use Faker\Generator as Faker;

$factory->define(App\Page::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'slug' => str_random(10),
        'description' => $faker->paragraph,
        'created_by' => 1,
    ];
});
