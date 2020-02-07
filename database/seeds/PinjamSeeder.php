<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PinjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i=0; $i<10; $i++){
            DB::table('pinjam')->insert([
                'kodepinjam' => $faker->numberBetween(1,10),
                'idbuku' => $faker->numberBetween(1,16),
                'idanggota' => $faker->numberBetween(5, 38),
                'tglpinjam' => $faker->dateTime(),
                'tglkembali' => $faker->dateTime(),
                'status' => $faker->numberBetween(0,1),
                'created_at'=> $faker->dateTime(),
                'updated_at'=> $faker->dateTime()
            ]);
        }
    }
}
