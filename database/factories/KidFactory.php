<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(App\Kid::class, function (Faker $faker) {
    return [
        'name' => $faker->FirstName() . ' ' . $faker->lastName()
    ];
});
