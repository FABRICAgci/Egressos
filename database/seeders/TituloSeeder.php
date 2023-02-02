<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TituloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('titulos')->insert([
            [
                'descricao' => 'Bacharel',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Especialista',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Mestre',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Doutor',
                'criador' => 1,
                'modificador' => 1,
            ],
            [
                'descricao' => 'Pós Doutor',
                'criador' => 1,
                'modificador' => 1,
            ],
        ]);
    }
}
