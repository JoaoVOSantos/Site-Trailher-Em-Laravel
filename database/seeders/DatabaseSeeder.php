<?php

namespace Database\Seeders;

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
            TipoProdutoSeeder::class,
            IngredienteSeeder::class,
            UsuarioSeeder::class,
        ]);
    }
}
