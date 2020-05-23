<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FuelType;
use App\PersonalVehicle;
use App\VehicleModel;
use App\FuelRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
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

        
        $selected = PersonalVehicle::where('user_id', '=', Auth::user()->id)->where('id', '=',  $request->get('v'))->first();
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
            $total_distance = 0;
            $total_cost = 0;
            $total_amount = 0;
            foreach ($fuelRecords as $f) {
                $cost[] = $f->cost;
                $amount[] = $f->refuel_amount;
                if($oldreading != 0)
                    $efficiency[] = ($f->odometer_reading - $oldreading)/$f->cost;
                

                $total_cost = $total_cost + $f->cost;
                $total_amount = $total_amount + $f->refuel_amount;

                if($oldreading != 0)
                    $total_distance = $total_distance + ($f->odometer_reading - $oldreading);

                $oldreading = $f->odometer_reading;
            }

            // $efficiency = array_shift($efficiency);
        $fuelTypes = FuelType::get();

        $a = 0;
        if($total_amount != 0)
            $a = $total_distance/$total_amount;
        $e = 0;
        if($total_cost != 0)
            $e = $total_distance/$total_cost;

        return view('home')
        ->with('fuel_types', $fuelTypes)
        ->with('selected', $selected)
        ->with('personal_vehicles', $personalVehicles)
        ->with('efficiency', $efficiency)
        ->with('cost', $cost)
        ->with('amount', $amount)
        ->with('a', $a)
        ->with('e', $e)
        ->with('fuel_records', $fuelRecords);   
    }

    public function upload(Request $request){
        $vehicle = $request->get('vehicle');
       $recipt = Storage::disk('s3')->putFile(Auth::user()->id.'/'.$vehicle, $request->file('file'));

    }

    public function about(Request $request){
       return view('about');
    }
    public function contact(Request $request){
       return view('contact');
    }
    public function help(Request $request){
       return view('faq');
    }
    public function terms(Request $request){
       return view('terms');
    }
    public function import(Request $request){
        Log::info($request->all());
        $cost = 0;
        if($request->get('cost'))
            $cost = $request->get('cost');

        $fuelType = "";
        if($request->get('ftype'))
            $fuelType = $request->get('ftype');

        $fuelRecord = new FuelRecord();


    }
}
