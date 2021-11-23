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
        $user_ids = User::pluck('id')->toArray();

        for($i = 0; $i < 50; $i++){
            $newPost = new Post();

            $newPost->title = $faker->sentence();
            $newPost->date = $faker->dateTimeBetween('-10 weeks', '+0 week');
            $newPost->content = $faker->paragraphs(5, true);

            $newPost->category_id = Arr::random($category_ids);
            $newPost->user_id = Arr::random($user_ids);

            $newPost-> save();
        }
    }
}
