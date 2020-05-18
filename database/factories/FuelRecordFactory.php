<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FuelRecord;
use Faker\Generator as Faker;

$factory->define(FuelRecord::class, function (Faker $faker) {
    return [
        'fuel_type_id'=>rand(1,5),
        'personal_vehicle_id'=>rand(1, 5),
        'cost'=>$faker->randomNumber,
        'odometer_reading'=> $faker->randomNumber,
        'receipt_number'=> $faker->randomNumber,
        'refuel_amount'=> $faker->randomNumber,
    ];
});