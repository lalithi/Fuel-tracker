<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    var $odometer_reading = 100;
    var $refuel_date =  null;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->refuel_date =  new Carbon('first day of January 2019', 'Australia/Melbourne');
         

        $u = factory(App\User::class)->create([
            'email'=>'admin@mail.com',
            'password'=>Hash::make('123123123'),
            'is_admin'=>true
        ]);
        $u->vehicles()->saveMany(factory(App\PersonalVehicle::class, 10)->create()->each(function ($personalVehicle) {
            $personalVehicle->fuel_records()->saveMany(factory(App\FuelRecord::class, 25)->create()->each(function ($fuelRecord) {
                $fuelRecord->odometer_reading = $this->odometer_reading+100;
                $this->odometer_reading = $this->odometer_reading+100;
                $fuelRecord->cost = rand(100, 120);
                $fuelRecord->refuel_amount = rand(40, 45);
                $fuelRecord->refuel_date = $this->refuel_date->add(7 ,'day');
            })
        );
        }));

        factory(App\User::class, 10)->create()->each(function ($user) {
            $user->vehicles()->saveMany(factory(App\PersonalVehicle::class, 10)->create()->each(function ($personalVehicle) {
             //   $personalVehicle->fuel_records()->saveMany(factory(App\FuelRecord::class, 25)->create());
            })
        );
        });
    }
}
