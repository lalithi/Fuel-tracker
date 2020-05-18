<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\VehicleBrand;
use Faker\Generator as Faker;

$factory->define(VehicleBrand::class, function (Faker $faker) {
    return [
        'name'=> $faker->name
    ];
});
