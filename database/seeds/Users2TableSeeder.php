<?php

use Illuminate\Database\Seeder;

class Users2TableSeeder extends Seeder
{
    const ITEMS_COUNT = 1000000;
    const CHUNK_SIZE = 1000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $number_of_chunks = self::ITEMS_COUNT / self::CHUNK_SIZE;
        DB::table('users2')->truncate();
        $faker = app(\Faker\Factory::class)->create();

        for ($chunk = 1; $chunk < $number_of_chunks; $chunk++) {
            $data = [];
            for ($i = 0; $i < self::CHUNK_SIZE; $i++) {
                $emails = [$faker->email, $faker->email, $faker->email, $faker->email];
                $data[] = [
                    'name' => 'some_user_name',
                    'gender' => mt_rand(1, 2),
                    'email' => implode(',', array_slice($emails, 0, mt_rand(0, 4)))
                ];
            }

            $this->command->comment('Chunk ' . $chunk . ' compiled and will be inserted soon');
            DB::table('users2')->insert($data);
            $this->command->comment('Chunk ' . $chunk . ' inserted');
        }
    }
}
