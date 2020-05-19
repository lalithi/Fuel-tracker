<?php

namespace App\Http\Controllers;

use App\VehicleBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = VehicleBrand::paginate(10);
        return view('brands.index')
        ->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = VehicleBrand::paginate(10);

        return view('brands.index')
        ->with('brands', $brands)
        ->with('brand_add', '[]');
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
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $brand = new VehicleBrand();
        $brand->name = $request->get('name');
        $brand->description = $request->get('description');
        $brand->save();

        $brands = VehicleBrand::paginate(10);
        return view('brands.index')
        ->with('brands', $brands)->with('success','Brand Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleBrand $brand)
    {
        $this->userHasPermission($brand);

        $brands = VehicleBrand::paginate(10);
        return view('brands.index')
        ->with('brand_more', $brand)
        ->with('brands', $brands);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleBrand $brand)
    {
        $this->userHasPermission($brand);

        $brands = VehicleBrand::paginate(10);
        return view('brands.index')
        ->with('brand_edit', $brand)
        ->with('brands', $brands);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleBrand $brand)
    { 
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
    ]);
    
        $brand->name = $request->get('name');
        $brand->description = $request->get('description');
        $brand->save();

        $brands = VehicleBrand::paginate(10);
        return view('brands.index')
        ->with('brands', $brands)->with('success','Brand Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleBrand  $vehicleBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleBrand $brand)
    {
        $brand->delete();

        $brands = VehicleBrand::paginate(10);
        return view('brands.index')
        ->with('brands', $brands)->with('warning','Brand Deleted successfully!');
    }


    private function userHasPermission(VehicleBrand $brand)
    {
        if(Auth::user()->isAdmin())
            return true;

        return false;
    }
}
