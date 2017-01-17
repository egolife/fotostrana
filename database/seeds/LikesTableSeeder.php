<?php

use FotoStrana\Post;
use FotoStrana\User;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->truncate();
        $users = User::all();

        Post::all()->each(function (Post $post) use ($users) {
            $post->liked()->attach($users->random(mt_rand(1, $users->count())));
        });
    }
}
