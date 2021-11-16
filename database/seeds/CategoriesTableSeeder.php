<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Generator as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $categories = ['Science', 'History', 'Business', 'Health', 'Technology' ];
        
        for($i=0; $i < 10; $i++){

            $newCategory = new Category();

            $newCategory->class = $faker->words(1, true);
            $newCategory->name = $faker->words(1, true);

            $newCategory-> save();
        }
        
        // foreach($categories as $name){

        //     $category = new Category();
            
        //     $category->name = $name;

        //     $category->save();
        // }
    }
}

