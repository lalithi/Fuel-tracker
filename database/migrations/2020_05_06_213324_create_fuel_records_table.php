<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('fuel_type_id');
            $table->unsignedInteger('personal_vehicle_id');
            $table->string('receipt_number');
            $table->string('cost');
            $table->string('odometer_reading');
            $table->string('refuel_amount');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel_records');
    }
}
