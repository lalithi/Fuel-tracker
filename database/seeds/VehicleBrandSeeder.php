<?php

use Illuminate\Database\Seeder;

class VehicleBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'Toyota'=>['Corolla', 'Camry', 'Aurion', 'Rav4', 'Land cruiser', 'Harrier', 'Kluger'],
            'Mitsubishi'=>['Lancer', 'ASX', 'Montero'],
            'Suzuki'=>['Swift', 'Alto', 'Baleno', 'Grand vitara'],
            'Lexus'=>['Harrier','IS250','RX350'],
            'BMW'=>['320d','520d','320i', '520i', 'x3','x5','x7','x9'],
            'Benz'=>['compressor', 'sprinter']
        ];

        foreach ($brands as $brand=>$models) {
            $brand = App\VehicleBrand::create(['name'=>$brand, 'description'=> '']);
            foreach ($models as $model) {
                App\VehicleModel::create(['name'=>$model, 'description'=> '', 'vehicle_brand_id'=>$brand->id]);
            }
        }
    }
}
