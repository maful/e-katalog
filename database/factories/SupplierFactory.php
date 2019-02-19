<?php

use Faker\Generator as Faker;

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'city_id' => $faker->unique()->numberBetween(1101, 1118),
        'nama' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'tahun_lahir' => $faker->year(),
    ];
});
