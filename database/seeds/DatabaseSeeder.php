<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SeederDepartaments::class);
        $this->call(SeederProvinces::class);
        $this->call(SeederTypeCampus::class);
        $this->call(SeederCampus::class);
    }
}
