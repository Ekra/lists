<?php
/**
 * Created by PhpStorm.
 * User: akirachix
 * Date: 2/20/15
 * Time: 2:39 PM

 */

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Suitcase\Domain\Models\Listing as Listing;


class ListingsTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 50) as $index)
        {
            Listing::create([
                'name' => $faker->name,
            ]);
        }
    }

} 