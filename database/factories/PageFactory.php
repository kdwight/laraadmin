<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'slug' => str_random(10),
        'description' => $faker->paragraph,
        'created_by' => 1,
    ];
});
