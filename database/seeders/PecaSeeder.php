<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PecaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt-BR');

        foreach(\range(1, 10) as $index){
           DB::table('peca')->insert([
            'nome' => $faker->name,
            'marca' => $faker->name,
            'quantidade' => $faker->randomNumber($nbDigits = 9, $strict = false),
            'preco' => $faker->randomNumber($nbDigits = 9, $strict = false),
           ]);
        }
    }
}
