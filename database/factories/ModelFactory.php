<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(FotoStrana\User::class, function (Faker\Generator $faker) {
    static $password, $i = 0;
    $i++;

    return [
        'name' => 'user' . $i,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(FotoStrana\Post::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph(10, true),
        'author_id' => function () {
            return factory(\FotoStrana\User::class)->create()->id;
        },
    ];
});

$factory->define(FotoStrana\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});
