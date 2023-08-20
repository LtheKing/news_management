<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 100; $i++){ 
            DB::table('tbl_news')->insert([
                'Title' => $faker->words(rand(5, 15), true),
                'Post' => $faker->paragraph,
                'Author' => $faker->name,
            ]);
        }
    }
}
