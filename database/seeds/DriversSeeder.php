<?php

use App\Driver;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DriversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Driver::create(['truck_number'=>525,    'full_name'=>'Ould Mohamed']);
        Driver::create(['truck_number'=>166367, 'full_name'=>'Ely Marco']);
        Driver::create(['truck_number'=>3195,   'full_name'=>'Sid Ahmed Markou']);
        Driver::create(['truck_number'=>526,    'full_name'=>'Oumar Mohamed']);
        Driver::create(['truck_number'=>521,    'full_name'=>'Mohamed Khiyarhoum']);
        User::create(["name"=>"Admin",'email'=>'admin@rimlogistics.com','password'=>Hash::make('admin1234')]);
    }
}
