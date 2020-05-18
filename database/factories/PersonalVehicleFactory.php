<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonalVehicle;
use Faker\Generator as Faker;

$factory->define(PersonalVehicle::class, function (Faker $faker) {
    return [
        'registration_number'=>$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.' - '.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit,
        'vehicle_model_id'=>rand(1,15),
        'user_id'=>rand(1,10)
    ];
});
