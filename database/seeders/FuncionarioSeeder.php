<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FuncionarioSeeder extends Seeder
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
           DB::table('funcionario')->insert([
            'nome' => $faker->name,
            'cnpj' => $faker->randomNumber($nbDigits = 9, $strict = false),
            'telefon' => $faker->randomNumber($nbDigits = 9, $strict = false),
            'salario' => $faker->randomNumber($nbDigits = 9, $strict = false),
            'horario' => $faker->randomNumber($nbDigits = 9, $strict = false),
           ]);
        }
    }
}
