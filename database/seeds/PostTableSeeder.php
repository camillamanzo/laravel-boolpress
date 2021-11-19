<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

use App\Models\Post;
use App\Models\Category;
use App\User;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $category_ids = Category::pluck('id')->toArray();

        for($i = 0; $i < 50; $i++){
            $newPost = new Post();

            $newPost->title = $faker->sentence();
            $newPost->author = $faker->name();
            $newPost->date = $faker->date();
            $newPost->content = $faker->paragraphs(5, true);

            $newPost->category_id = Arr::random($category_ids);

            $newPost-> save();
        }
    }
}
