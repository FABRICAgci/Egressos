<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Usuário Administrador',
            'email' => 'admin@egresso.com.br',
            'password' => Hash::make('123456'),
            'perfil' => 1,
            'criador' => 1,
            'modificador' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Usuário Egresso',
            'countrie_nascimento' => 32,
            'uf_nascimento' => 15,
            'cidade_nascimento' => 1501402,
            'countrie_mora' => 32,
            'uf_mora' => 15,
            'cidade_mora' => 1501402,
            'ano_ingresso' => 2010,
            'ano_formatura' => 2015,
            'dt_nascimento' => '1982-04-07',
            'email' => 'egresso@egresso.com.br',
            'password' => Hash::make('123456'),
            'perfil' => 2,
            'criador' => 1,
            'modificador' => 1,
        ]);
    }
}
