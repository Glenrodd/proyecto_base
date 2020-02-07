<?php

use Illuminate\Database\Seeder;

class SeederTypeCampus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_campus')->insert(  [
            'name' => 'CENTRAL'
            ]
        );

        DB::table('types_campus')->insert(  [
                'name' => 'SUCURSAL'
            ]
        );
    }
}
