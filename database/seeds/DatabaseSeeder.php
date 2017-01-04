<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Maker;
Use App\User;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{


        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Maker::truncate();
        User::truncate();
        Model::unguard();

		$this->call('MakerSeed');
        $this->call('VehicleSeed');
        $this->call('UserSeed');

	}

}
