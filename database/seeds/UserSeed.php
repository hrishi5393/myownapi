<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Maker;
Use App\User;
use Faker\Factory as Faker;

class UserSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        User::Create([
            'email'=> 'fake@fake.com',
            'password'=>Hash::make('pass')

        ]);

    }

}
