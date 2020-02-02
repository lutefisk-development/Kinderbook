<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(App\Kid::class, function (Faker $faker) {
    return [
        'first_name' => $faker->FirstName(),
        'last_name' => $faker->lastName(),
    ];
});
