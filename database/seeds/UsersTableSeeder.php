<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
               	'name' => 'roddwy',
        		'email' => 'roddwy@gmail.com',
        		'password' => Hash::make('12345678'),
        		'api_token' => hash('sha256', Str::random(80)),
            ]
        );
    }
}
