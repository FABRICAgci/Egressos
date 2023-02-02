<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrieSeeder::class,
            UfSeeder::class,
            CidadeSeeder::class,
            TituloSeeder::class,
            AreaSeeder::class,
            UserSeeder::class,
        ]);
    }
}
