<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FuelType;
use App\PersonalVehicle;
use App\VehicleModel;
use App\FuelRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
            $refuel_date = [];
            $oldreading = 0;
            $total_distance = 0;
            $total_cost = 0;
            $total_amount = 0;
            foreach ($fuelRecords as $f) {
                $cost[] = $f->cost;
                $amount[] = $f->refuel_amount;
                if($oldreading != 0)
                    $efficiency[] = ($f->odometer_reading - $oldreading)/$f->cost;
                // $d = Carbon::createFromFormat('Y-m-d', $f->refuel_date);
                // if(!$d)
                // $d = Carbon::now();
             
                $refuel_date[] = $f->refuel_date;
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
        ->with('refuel_date', $refuel_date)
        ->with('personal_vehicles', $personalVehicles)
        ->with('efficiency', $efficiency)
        ->with('cost', $cost)
        ->with('amount', $amount)
        ->with('a', $a)
        ->with('e', $e)
        ->with('fuel_records', $fuelRecords);   
    }

    public function upload(Request $request){
        $vehicle = $request->get('vehicle_id');
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
        $amount = 0;
            if($request->get('amount'))
                $amount = $request->get('amount');

        $fuelType = "";
        if($request->get('ftype'))
            if(FuelType::where('name', '=',$request->get('ftype'))->first())
                $fuelType = FuelType::where('name', '=',$request->get('ftype'))->first()->id;

        $fuelRecord = new FuelRecord();
        $fuelRecord->fuel_type_id = $fuelType;
        $fuelRecord->personal_vehicle_id = $request->get('vehicle');
        $fuelRecord->cost = $cost;
        $fuelRecord->refuel_amount = $amount;
        $fuelRecord->refuel_date = Carbon::now('Australia/Melbourne')->format("Y-m-d");
        $fuelRecord->save();
    }
}