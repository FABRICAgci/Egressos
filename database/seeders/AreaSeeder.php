<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
                'descricao' => 'Segurança da Informação',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Suporte técnico',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Programação Web',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Programação Mobile',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Programação',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Qualidade de Software',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Administração de Redes',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Administração de Banco de Dados',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Cloud Computing',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Robótica',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Empreendedor',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Servidor Público',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Outros',
                'criador' => 1,
                'modificador' => 1,
            ],
        ]);
    }
}
