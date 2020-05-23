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
            $table->unsignedInteger('fuel_type_id')->default(1);
            $table->unsignedInteger('personal_vehicle_id')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('cost')->default("0.00");
            $table->string('odometer_reading')->default("0");
            $table->string('refuel_amount')->default("0");
            $table->string('refuel_date')->nullable();
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
