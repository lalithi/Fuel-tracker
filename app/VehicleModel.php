<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class VehicleModel extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    public function models(){
        return $this->belongsTo('App\PersonalVehicle', 'vehicle_brand_id');
    }

    public function vehicles(){
        return $this->hasMany('App\VehicleModel'); 
    }
}
