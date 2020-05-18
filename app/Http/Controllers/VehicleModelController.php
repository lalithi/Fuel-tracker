<?php

namespace App\Http\Controllers;

use App\VehicleModel;
use App\VehicleBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = VehicleModel::paginate(10);
        return view('models.index')
        ->with('models', $models);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models = VehicleModel::paginate(10);
        $brands = VehicleBrand::get();

        return view('models.index')
        ->with('models', $models)
        ->with('brands', $brands)
        ->with('model_add', '[]');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new VehicleModel();
        $model->name = $request->get('name');
        $model->description = $request->get('description');
        $model->save();

        $brands = VehicleBrand::get();
        $models = VehicleModel::paginate(10);
        return view('models.index')
        ->with('brands', $brands)
        ->with('models', $models);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleModel  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleModel $model)
    {
        $this->userHasPermission($model);

        $models = VehicleModel::paginate(10);
        return view('models.index')
        ->with('model_more', $model)
        ->with('models', $models);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VehicleModel  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleModel $model)
    {
        $this->userHasPermission($model);

        $brands = VehicleBrand::get();
        $models = VehicleModel::paginate(10);
        return view('models.index')
        ->with('model_edit', $model)
        ->with('brands', $brands)
        ->with('models', $models);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleModel  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleModel $model)
    {
        $brands = VehicleBrand::get();
        $model->name = $request->get('name');
        $model->description = $request->get('description');
        $model->save();

        $models = VehicleModel::paginate(10);
        return view('models.index')
        ->with('model_edit', $model)
        ->with('brands', $brands)
        ->with('models', $models);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleModel  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleModel $model)
    {
        $model->delete();

        $models = VehicleModel::paginate(10);
        return view('models.index')
        ->with('models', $models);
    }


    private function userHasPermission(VehicleModel $model)
    {
        if(Auth::user()->isAdmin())
            return true;

        return false;
    }
}
