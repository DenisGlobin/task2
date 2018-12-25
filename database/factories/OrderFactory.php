<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'message' => $faker->paragraph,
        'file_path' => null,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
