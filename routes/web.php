<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // vehicle brands
    // Route::get('/brands/{brand}', 'VehicleBrandController@show')->name('brands.details');
    // Route::get('/brands/{brand}/edit', 'VehicleBrandController@edit')->name('brand-edit');
    // Route::patch('/brands/{brand}', 'VehicleBrandController@update')->name('brand-patch');
    Route::get('/brands/{brand}/delete', 'VehicleBrandController@destroy')->name('brand-delete');
    // Route::post('/brands/{brand}', 'VehicleBrandController@store');
    // Route::get('/brands', 'VehicleBrandController@index');
    Route::resource('brands', 'VehicleBrandController');

    // vehicle models
    // Route::get('/models/{model}', 'VehicleModelController@show')->name('vehicle-model-details');
    // Route::get('/models/{model}/edit', 'VehicleModelController@edit')->name('vehicle-model-edit');
    // Route::patch('/models/{model}', 'VehicleModelController@update')->name('vehicle-model-patch');
    Route::get('/models/{vehicle-model}/delete', 'VehicleModelController@destroy')->name('vehicle-model-delete');
    // Route::post('/models/{vehicle-model}', 'VehicleModelController@store');
    // Route::get('/models', 'VehicleModelController@index');
    Route::resource('models', 'VehicleModelController');

    // Personal vehicles
    // Route::get('/vehicles/{vehicle}', 'PersonalVehicleController@show')->name('vehicle-details');
    // Route::get('/vehicles/{vehicle}/edit', 'PersonalVehicleController@edit')->name('vehicle-edit');
    // Route::patch('/vehicles/{vehicle}', 'PersonalVehicleController@update')->name('vehicle-patch');
    Route::get('/vehicles/{vehicle}/delete', 'PersonalVehicleController@destroy')->name('vehicle-delete');
    // Route::post('/vehicles/{vehicle}', 'PersonalVehicleController@store');
    // Route::get('/vehicles', 'PersonalVehicleController@index');
    Route::resource('vehicles', 'PersonalVehicleController');

    // Fuel- records
    Route::get('/fuel-records/{fuel-record-id}', 'FuelRecordController@show')->name('fuel-record-details');
    Route::get('/fuel-records/{fuel-record-id}/edit', 'FuelRecordController@edit')->name('fuel-record-edit');
    Route::patch('/fuel-records/{fuel-record-id}', 'FuelRecordController@update')->name('fuel-record-patch');
    Route::get('/fuel-records/{fuel-record}/delete', 'FuelRecordController@destroy')->name('fuel-record-delete');
    Route::post('/fuel-records/{fuel-record}', 'FuelRecordController@store');
    Route::get('/fuel-records', 'FuelRecordController@index');
    Route::resource('fuel-records', 'FuelRecordController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
