<?php

use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $array = [];
        foreach (range(1,10) as $index) {
            $array [] = [
                'title' => $faker->sentence(8),
                'completed' => rand(0,1),
                'created_at' => Carbon\Carbon::now()
            ];
        }

        \App\Todo::insert($array);
    }
}
