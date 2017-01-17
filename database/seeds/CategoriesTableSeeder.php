<?php

use FotoStrana\Category;
use FotoStrana\Post;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_post')->truncate();
        Category::truncate();
        /**
         * @var $categories \Illuminate\Database\Eloquent\Collection
         */
        $categories = factory(Category::class, 4)->create();

        Post::all()->each(function (Post $post) use ($categories) {
            $post->categories()->attach($categories->random(2));
        });
    }
}
