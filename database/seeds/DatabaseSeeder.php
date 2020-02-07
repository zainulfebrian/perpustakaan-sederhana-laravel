<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker=Faker::create('id_ID');

        for($i=0; $i<50; $i++){
            DB::table('buku')->insert([
                'judul' => $faker->sentence(),
                'pengarang' => $faker->name(),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
