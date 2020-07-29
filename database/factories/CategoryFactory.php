<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
	$word = $faker->sentence(2);
    return [
        'name' => ucfirst($word),
        'slug' => str_slug($word),
        'description' => $faker->sentence(10)
    ];
});
