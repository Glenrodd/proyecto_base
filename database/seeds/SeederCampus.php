<?php

use Illuminate\Database\Seeder;

class SeederCampus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campus')->insert(  [
                'name' => 'ACHACHICALA',
                'type_campus_id' => 1,
                'deparment_id' => 1,
                'province_id' => 1,
                'address'  => 'Zona Achachicala, Av. Chacaltaya #1258',
                'phones' => '2305210 - 2305252 - 2305861'
            ]
        );
    }
}
