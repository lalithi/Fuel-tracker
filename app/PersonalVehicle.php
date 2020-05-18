<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalVehicle extends Model
{
    use SoftDeletes;
    public function model(){
        return $this->belongsTo('App\VehicleModel', 'vehicle_model_id');
    }

    public function owner(){
        return $this->belongsTo('App\User');
    }

    public function fuel_records(){
        return $this->hasMany('App\FuelRecord');
    }
}
