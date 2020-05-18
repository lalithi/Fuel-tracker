<?php

use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuelTypes = ['E10', 'E85', 'Premium 98-octane unleaded', 'Standard unleaded petrol (91)', 'Diesal'];
        foreach ($fuelTypes as $key) {
            $fuelType = new \App\FuelType();
            $fuelType->name = $key;
            $fuelType->save();
        }
    }
}
