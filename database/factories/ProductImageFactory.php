<?php

use Faker\Generator as Faker;
use App\ProductImage;

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
        // 'image' => 'https://i.picsum.photos/id/1/200/200.jpg', No mostraba las imagenes
        'image' => 'https://picsum.photos/200',
        'product_id' => $faker->numberBetween(1, 100)
    ];
});
