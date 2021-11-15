<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Generator as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i < 50; $i++){
            $newPost = new Post();

            $newPost->title = $faker->sentence();
            $newPost->author = $faker->name();
            $newPost->date = $faker->date();
            $newPost->content = $faker->paragraphs(5, true);

            $newPost-> save();
        }
    }
}
