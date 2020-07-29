<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
	$word = substr($faker->sentence(3), 0, -1);
    return [
        'name' => $word,
        'slug' => str_slug($word),
        'description' => $faker->sentence(10),
        'long_description' => $faker->text,
        'price' => $faker->randomFloat(2, 5, 50),

        'category_id' => $faker->numberBetween(1, 4)
    ];
});
