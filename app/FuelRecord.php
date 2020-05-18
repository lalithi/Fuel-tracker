<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelRecord extends Model
{
    use SoftDeletes;
    public function vehicle(){
        return $this->belongsTo('App\PersonalVehicle', 'personal_vehicle_id');
    }
}
