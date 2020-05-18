<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleBrand extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    
    public function models(){
        return $this->hasMany('App\VehicleModel'); 
    }
}
