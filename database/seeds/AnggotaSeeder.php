<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i=0; $i<50; $i++){
            DB::table('anggota')->insert([
                'nama' => $faker->name(),
                'kelas' => $faker->numberBetween(1, 3),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }
    }
}
