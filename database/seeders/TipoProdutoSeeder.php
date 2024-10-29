<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoProduto; // Certifique-se de ter o modelo correspondente

class TipoProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adicione alguns tipos de produtos
        TipoProduto::create(['nome' => 'Bebida']);
        TipoProduto::create(['nome' => 'Porção']);
        TipoProduto::create(['nome' => 'Pizzas Pequenas']);
        TipoProduto::create(['nome' => 'Pizzas']);
        TipoProduto::create(['nome' => 'Lanches']);
        TipoProduto::create(['nome' => 'Lanche Artesanal']);
        TipoProduto::create(['nome' => 'Beirute']);
        TipoProduto::create(['nome' => 'Mini Lanches']);
        TipoProduto::create(['nome' => 'Combo Mini Lanches']);
        TipoProduto::create(['nome' => 'Combo Porções']);
        TipoProduto::create(['nome' => 'Caldo']);
        TipoProduto::create(['nome' => 'Porção Individual Pote']);
        TipoProduto::create(['nome' => 'Strogofritas']);
        TipoProduto::create(['nome' => 'Pastel']);
        TipoProduto::create(['nome' => 'Pastel Quaresma']);
        TipoProduto::create(['nome' => 'Pastel Doce']);
        TipoProduto::create(['nome' => 'Mini Pastelzinho']);
        TipoProduto::create(['nome' => 'Mini Pastelzinho Doce']);
        TipoProduto::create(['nome' => 'Tapioca Salgada']);
        TipoProduto::create(['nome' => 'Tapioca Doce']);
        TipoProduto::create(['nome' => 'Esfirra']);
        TipoProduto::create(['nome' => 'Esfirra Doce']);
        TipoProduto::create(['nome' => 'Açai Frooty']);
        
    }
}
