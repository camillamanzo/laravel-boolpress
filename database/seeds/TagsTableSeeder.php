<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 5; $i++){

            $newTag = new Tag();
            $newTag->name = $faker->words(1, true);
            $newTag->color = $faker->hexColor();

            $newTag->save();
        }
    }
}