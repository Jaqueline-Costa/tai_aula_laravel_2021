<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PecaCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt-BR');

        DB::table('peca_categoria')->insert(
            [
                [
                    'nome' => "Material de construção",
                ],
                [
                    'nome' => "Ferramenta",
                ],
            ]
        );
    }
}
