<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredienteSeeder extends Seeder
{
    public function run()
    {
        $ingredientes = [
            'Salame',
            'Calabresa',
            'Batata Frita',
            'Anel de Cebola',
            'Polenta',
            'Frango',
            'Bacon',
            'Frango Empanado',
            'Presunto',
            'Mussarela',
            'Catupiry',
            'Cheddar',
            'Queijo Prato',
            'Ovo',
            'Brócolis',
            'Mandioca',
            'Galinha desfiada',
            'Boi Moído',
            'Cream Cheese',
            'Tomate',
            'Orégano',
            'Milho',
            'Carne',
            'Palmito',
            'Frango Temperado',
            'Carne Temperada',
            'Atum',
            'Azeitona',
            'Chocolate',
            'Brigadeiro',
            'Nutella',
            'Morango',
            'Doce de Leite',
            'Goiabada',
            'Ervilha',
            'Cebola',
            'Limão',
            'Gorgonzola',
            'Parmesão',
            'Confete',
            'Banana',
            'Leite Condensado',
            'Canela',
            'Granulado',
            'Kit Kat',
            'Chocolate Branco',
            'Coco',
            'Granola',
            'Leite Ninho',
            'Choco Power Ball',
            'Kiwi',
        ];

        foreach ($ingredientes as $ingrediente) {
            DB::table('ingredientes')->insert([
                'nome' => $ingrediente,
            ]);
        }
    }
}
