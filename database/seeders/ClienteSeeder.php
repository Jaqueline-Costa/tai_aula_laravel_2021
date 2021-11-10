<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
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
           DB::table('cliente')->insert([
            'nome' => $faker->name,
            'telefone' => $faker->randomNumber($nbDigits = 9, $strict = false),
            'email' => $faker->name,
            'data_inicio' => $faker->randomNumber($nbDigits = 9, $strict = false),
            'data_final' => $faker->randomNumber($nbDigits = 9, $strict = false),
           ]);
        }
    }
}
