<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use Faker\Factory as Faker;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            $data = [
                'kategori' => $faker->city,
                'keterangan' => $faker->text
            ];

            Kategori::create($data);
        }
    }
}
