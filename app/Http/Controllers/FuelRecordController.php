<?php

namespace App\Http\Controllers;

use App\FuelRecord;
use App\FuelType;
use App\PersonalVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FuelRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $fuelRecords = FuelRecord::select('fuel_records.*')->join('personal_vehicles as ps', 'ps.id', '=', 'fuel_records.personal_vehicle_id')
        ->where('ps.user_id', '=', Auth::user()->id)
        ->where('ps.deleted_at', '=', null)
        ->paginate(15);
        // dd($fuelRecords);
        // $fuelRecords = FuelRecord::paginate(10);
        return view('fuel_records.index')
        ->with('fuel_records', $fuelRecords);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personalVehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->get();
        $fuelTypes = FuelType::get();
        $fuelRecords = FuelRecord::select('fuel_records.*')->join('personal_vehicles as ps', 'ps.id', '=', 'fuel_records.personal_vehicle_id')
        ->where('ps.user_id', '=', Auth::user()->id)
        ->where('ps.deleted_at', '=', null)
        ->paginate(15);

        return view('fuel_records.index')
        ->with('fuel_records', $fuelRecords)
        ->with('fuel_types', $fuelTypes)
        ->with('personal_vehicles', $personalVehicles)
        ->with('fuel_record_add', '[]');
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
            'receipt_number' => 'required|max:255',
            'cost' => 'required|numeric',
            'odometer_reading' => 'required|numeric',
            'refuel_amount' => 'required|numeric',
            'fuel_type_id' => 'required',
            'personal_vehicle_id' => 'required',
        ]);

        $fuelRecord = new FuelRecord();
        $fuelRecord->receipt_number = $request->get('receipt_number');
        $fuelRecord->cost = $request->get('cost');
        $fuelRecord->odometer_reading = $request->get('odometer_reading');
        $fuelRecord->refuel_amount = $request->get('refuel_amount');
        $fuelRecord->fuel_type_id = $request->get('fuel_type_id');
        $fuelRecord->personal_vehicle_id = $request->get('personal_vehicle_id');
        $fuelRecord->save();

        $fuelRecords = FuelRecord::select('fuel_records.*')->join('personal_vehicles as ps', 'ps.id', '=', 'fuel_records.personal_vehicle_id')
        ->where('ps.user_id', '=', Auth::user()->id)
        ->where('ps.deleted_at', '=', null)
        ->paginate(15);
        return view('fuel_records.index')
        ->with('fuel_record_more', $fuelRecord)
        ->with('fuel_records', $fuelRecords)->with('success','Fuel Record Added successfully!');
    }

    /**
     * Display the specified resource.
     *regisreation-number}/{fuel-record-id
     * @param  \App\FuelRecord  $fuelRecord
     * @return \Illuminate\Http\Response
     */
    public function show(FuelRecord $fuelRecord)
    {
       
        $this->userHasPermission($fuelRecord);

        $fuelRecords = FuelRecord::select('fuel_records.*')->join('personal_vehicles as ps', 'ps.id', '=', 'fuel_records.personal_vehicle_id')
        ->where('ps.user_id', '=', Auth::user()->id)
        ->where('ps.deleted_at', '=', null)
        ->paginate(15);
        return view('fuel_records.index')
        ->with('fuel_record_more', $fuelRecord)
        ->with('fuel_records', $fuelRecords);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FuelRecord  $fuelRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(FuelRecord $fuelRecord)
    {
           
        $this->userHasPermission($fuelRecord);
        $personalVehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->get();
        $fuelTypes = FuelType::get();
        $fuelRecords = FuelRecord::select('fuel_records.*')->join('personal_vehicles as ps', 'ps.id', '=', 'fuel_records.personal_vehicle_id')
        ->where('ps.user_id', '=', Auth::user()->id)
        ->where('ps.deleted_at', '=', null)
        ->paginate(15);
        return view('fuel_records.index')
        ->with('fuel_types', $fuelTypes)
        ->with('personal_vehicles', $personalVehicles)
        ->with('fuel_record_edit', $fuelRecord)
        ->with('fuel_records', $fuelRecords);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FuelRecord  $fuelRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuelRecord $fuelRecord)
    {
        $validatedData = $request->validate([
            'receipt_number' => 'required|max:255',
            'cost' => 'required|numeric',
            'odometer_reading' => 'required|numeric',
            'refuel_amount' => 'required|numeric',
            'fuel_type_id' => 'required',
            'personal_vehicle_id' => 'required',
        ]);

       
        $fuelRecord->receipt_number = $request->get('receipt_number');
        $fuelRecord->cost = $request->get('cost');
        $fuelRecord->odometer_reading = $request->get('odometer_reading');
        $fuelRecord->refuel_amount = $request->get('refuel_amount');
        $fuelRecord->fuel_type_id = $request->get('fuel_type_id');
        $fuelRecord->personal_vehicle_id = $request->get('personal_vehicle_id');
        $fuelRecord->save();

        $personalVehicles = PersonalVehicle::where('user_id', '=', Auth::user()->id)->get();
        $fuelTypes = FuelType::get();

        $fuelRecords = FuelRecord::select('fuel_records.*')->join('personal_vehicles as ps', 'ps.id', '=', 'fuel_records.personal_vehicle_id')
        ->where('ps.user_id', '=', Auth::user()->id)
        ->where('ps.deleted_at', '=', null)
        ->paginate(15);
        return view('fuel_records.index')
        ->with('fuel_types', $fuelTypes)
        ->with('personal_vehicles', $personalVehicles)
        ->with('fuel_records', $fuelRecords)->with('success','Fuel Record Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FuelRecord  $fuelRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuelRecord $fuelRecord)
    {
        $fuelRecord->delete();

        $fuelRecords = FuelRecord::select('fuel_records.*')->join('personal_vehicles as ps', 'ps.id', '=', 'fuel_records.personal_vehicle_id')
        ->where('ps.user_id', '=', Auth::user()->id)
        ->where('ps.deleted_at', '=', null)
        ->paginate(15);
        return view('fuel_records.index')
        ->with('fuel_records', $fuelRecords)->with('warning','Fuel Record Removed successfully!');
    }

    private function userHasPermission(FuelRecord $fuelRecord)
    {
        if(Auth::user()->isAdmin())
            return true;

        if((Auth::user() && ( Auth::user()->id == $fuelRecord->vehicle->registration_number)))
            return true;

        return false;
    }
}
