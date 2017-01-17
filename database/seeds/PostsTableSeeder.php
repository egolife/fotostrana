<?php

use FotoStrana\Post;
use FotoStrana\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        User::take(5)->get()->each(function (User $user) {
            $user->posts()->saveMany(factory(Post::class, mt_rand(2, 5))->make(['author_id' => '']));
        });
    }
}
