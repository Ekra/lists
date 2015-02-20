<?php

use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Model as Eloquent;
use Suitcase\Domain\Models\User as User;
use Suitcase\Domain\Models\Listing as Listing;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        User::truncate();
       Listing::truncate();

        Eloquent::unguard();

		 $this->call('UsersTableSeeder');
        $this->call('ListingsTableSeeder');
	}

}
