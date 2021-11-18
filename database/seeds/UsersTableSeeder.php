<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        // saving my avatar
        // $user = new User();

        // $user->name = 'camilla';
        // $user->email = 'mailprova@gmail.com';
        // $user->password = bcrypt('ciaociao');

        // $user->save();

        // creating random users
        for ($i = 0; $i < 10; $i++) {
        $newUser = new User();

        $newUser->name = $faker->userName();
        $newUser->email = $faker->email();
        $newUser->password = bcrypt( $faker->password(8, 14) );

        $newUser->save();
       }
    }
}
