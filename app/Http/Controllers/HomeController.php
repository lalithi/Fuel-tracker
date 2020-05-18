<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FuelType;
use App\PersonalVehicle;
use App\VehicleModel;
use App\FuelRecord;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PersonalVehicle $selected = null)
    {
        $personalVehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->get();

        if(count($personalVehicles)==0){
            $vehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->paginate(10);
            $models   = VehicleModel::withTrashed()->get();

            return view('personal_vehicles.index')
            ->with('vehicles', $vehicles)
            ->with('models', $models)
            ->with('vehicle_add', '[]');
        }


        if(!$selected)
            $selected = $personalVehicles->first();

            $fuelRecords = FuelRecord::join('personal_vehicles', 'personal_vehicles.id', '=', 'fuel_records.personal_vehicle_id')
            ->where('personal_vehicles.id', '=', $selected->id)
            ->where('personal_vehicles.deleted_at', '=', null)
            ->get();
            $cost = [];
            $amount = [];
            $efficiency = [];
            $oldreading = 0;
            foreach ($fuelRecords as $f) {
                $cost[] = $f->cost;
                $amount[] = $f->refuel_amount;
                $efficiency[] = ($f->odometer_reading - $oldreading)/$f->cost;
                $oldreading = $f->odometer_reading;
            }

        $fuelTypes = FuelType::get();

        return view('home')
        ->with('fuel_types', $fuelTypes)
        ->with('selected', $selected)
        ->with('personal_vehicles', $personalVehicles)
        ->with('efficiency', $efficiency)
        ->with('cost', $cost)
        ->with('amount', $amount)
        ->with('fuel_records', $fuelRecords);   
    }
}
