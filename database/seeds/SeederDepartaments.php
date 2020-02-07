<?php

use Illuminate\Database\Seeder;

class SeederDepartaments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deparments')->insert(
            [
                   'name' => 'LA PAZ',
                   'shortened' => 'LP'
            ]
        );
        DB::table('deparments')->insert(
            [
                   'name' => 'COCHABAMBA',
                   'shortened' => 'CBBA'
            ]
        );
        DB::table('deparments')->insert(
            [
                   'name' => 'SANTA CRUZ',
                   'shortened' => 'SC'
            ]
        );
    }
}
