<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FuncionarioCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt-BR');

        DB::table('funcionario_categoria')->insert(
            [
                [
                    'nome' => "Pedreiro",
                ],
                [
                    'nome' => "Secretário",
                ],
                [
                    'nome' => "Encanador",
                ],
                [
                    'nome' => "Pintos",
                ],
                [
                    'nome' => "Engenheiro",
                ]
            ]
        );
    }
}
