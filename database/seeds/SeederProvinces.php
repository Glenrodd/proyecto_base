<?php

use Illuminate\Database\Seeder;

class SeederProvinces extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert(  [
                'name' => 'MURRILLO',
                'deparment_id' => 1
            ]
        );
        DB::table('provinces')->insert(  [
                'name' => 'QUILLACOLLO',
                'deparment_id' => 2
            ]
        );
        DB::table('provinces')->insert(  [
                'name' => 'ANDRES IBAÑEZ',
                'deparment_id' => 3
            ]
        );
        DB::table('provinces')->insert(  [
                'name' => 'CORDILLERA',
                'deparment_id' => 3
            ]
        );
        DB::table('provinces')->insert(  [
                'name' => 'ICHILO',
                'deparment_id' => 3
            ]
        );
    }
}
