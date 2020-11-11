<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        DB::table('vehicles')->insert([
            [
                'brand' => $faker->vehicleBrand,
                'model' => $faker->vehicleModel,
                'plate_number' => $faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'),
                'insurance_date' => date('Y-m-d'),
            ],
            [
                'brand' => $faker->vehicleBrand,
                'model' => $faker->vehicleModel,
                'plate_number' => $faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'),
                'insurance_date' => date('Y-m-d'),
            ],
        ]);
    }
}
