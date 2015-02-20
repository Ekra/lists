<?php
/**
 * Created by PhpStorm.
 * User: akirachix
 * Date: 2/20/15
 * Time: 9:53 AM
 */

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Suitcase\Domain\Models\User as User;

class UsersTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 50) as $index)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->text,
            ]);
        }
    }
}