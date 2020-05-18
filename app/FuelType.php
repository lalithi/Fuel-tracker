<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelType extends Model
{
    use SoftDeletes;
    public function fuel_records(){
        return $this->hasMany('App\FuelRecord');
    }
}
