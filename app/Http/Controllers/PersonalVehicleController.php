<?php

namespace App\Http\Controllers;

use App\PersonalVehicle;
use App\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PersonalVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personalVehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->get();

        $personalVehiclesData = [];
        foreach ($personalVehicles as $personalVehicle) {
            $data = collect();

            $data->registration_number = '';
            if($personalVehicle)
                $data->registration_number = $personalVehicle->registration_number;


            $data->model = '';
            $model = \App\VehicleModel::withTrashed()->where('id', '=', $personalVehicle->vehicle_model_id)->first();
            if($model)
                $data->model = $model->name;

             
            $data->brand = '';
            $vehicleBrand = '';
          
            $vehicleBrand = \App\VehicleBrand::withTrashed()->find($model->vehicle_brand_id);
            if($vehicleBrand)
                $data->brand = $vehicleBrand->name;



            $data->last_fueled_cost = '0.00';
            if($personalVehicle->fuel_records->last())
            {
                $data->last_fueled_cost = $personalVehicle->fuel_records->last()->cost;
            }

            $data->last_fueled_date = '-';
            if($personalVehicle->fuel_records->last())
            {
                // dd(Carbon::withTrashed()->now()->diffForHumans($personalVehicle->fuel_records->last()->created_at));
                $data->last_fueled_date = $personalVehicle->fuel_records->last()->created_at->format('l jS \\of F Y, h:i:s A');
            }
            $data->more = url('/vehicles/'.$personalVehicle->id);

            $personalVehiclesData[] = $data;
        }

        return view('personal_vehicles.tiles')
        ->with('vehicles', $personalVehiclesData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->paginate(10);
        $models = VehicleModel::withTrashed()->get();

        return view('personal_vehicles.index')
        ->with('vehicles', $vehicles)
        ->with('models', $models)
        ->with('vehicle_add', '[]');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'registration_number' => 'required|max:255',
            'model_id' => 'required'
            ]);

        $vehicle = new PersonalVehicle();
        $vehicle->registration_number = $request->get('registration_number');
        $vehicle->vehicle_model_id = $request->get('model_id');
        $vehicle->user_id = Auth::user()->id;
        $vehicle->save();

        $models = VehicleModel::get();
        $vehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('personal_vehicles.index')
        ->with('models', $models)
        ->with('vehicles', $vehicles)->with('success','Vehicle Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalVehicle  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalVehicle $vehicle)
    {
        $this->userHasPermission($vehicle);

        $model = '';
        $model_ = \App\VehicleModel::withTrashed()->find($vehicle->vehicle_model_id)->first();
        if($model_)
            $model = $model_->name;

         
        $brand = '';
        $vehicleBrand = '';
        if($model_)
        $vehicleBrand = \App\VehicleBrand::withTrashed()->find($model_->vehicle_brand_id)->first();
        if($vehicleBrand)
            $brand = $vehicleBrand->name;

        $vehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('personal_vehicles.index')
        ->with('vehicle_more', $vehicle)
        ->with('model', $model)
        ->with('brand', $brand)
        ->with('vehicles', $vehicles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalVehicle  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalVehicle $vehicle)
    {
        $this->userHasPermission($vehicle);

        $models = VehicleModel::get();
        $vehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('personal_vehicles.index')
        ->with('vehicle_edit', $vehicle)
        ->with('models', $models)
        ->with('vehicles', $vehicles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalVehicle  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalVehicle $vehicle)
    {
        $validatedData = $request->validate([
            'registration_number' => 'required|max:255',
            'model_id' => 'required'
            ]);

        $models = VehicleModel::get();
        $vehicle->registration_number = $request->get('registration_number');
        $vehicle->vehicle_model_id = $request->get('model_id');
        $vehicle->user_id = Auth::user()->id;
        $vehicle->save();

        $vehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('personal_vehicles.index')
        ->with('vehicle_edit', $vehicle)
        ->with('models', $models)
        ->with('vehicles', $vehicles)->with('success','Vehicle Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalVehicle  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalVehicle $vehicle)
    {
        $vehicle->delete();

        $vehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('personal_vehicles.index')
        ->with('vehicles', $vehicles)->with('warning','Vehicle Removed successfully!');
    }


    private function userHasPermission(PersonalVehicle $vehicle)
    {
        if(Auth::user()->isAdmin())
            return true;

        return false;
    }
}
