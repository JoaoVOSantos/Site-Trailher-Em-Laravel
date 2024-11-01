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
        TipoProduto::create(['tip_nome' => 'Bebida']);
        TipoProduto::create(['tip_nome' => 'Porção']);
        TipoProduto::create(['tip_nome' => 'Pizzas Pequenas']);
        TipoProduto::create(['tip_nome' => 'Pizzas']);
        TipoProduto::create(['tip_nome' => 'Lanches']);
        TipoProduto::create(['tip_nome' => 'Lanche Artesanal']);
        TipoProduto::create(['tip_nome' => 'Beirute']);
        TipoProduto::create(['tip_nome' => 'Mini Lanches']);
        TipoProduto::create(['tip_nome' => 'Combo Mini Lanches']);
        TipoProduto::create(['tip_nome' => 'Combo Porções']);
        TipoProduto::create(['tip_nome' => 'Caldo']);
        TipoProduto::create(['tip_nome' => 'Porção Individual Pote']);
        TipoProduto::create(['tip_nome' => 'Strogofritas']);
        TipoProduto::create(['tip_nome' => 'Pastel']);
        TipoProduto::create(['tip_nome' => 'Pastel Quaresma']);
        TipoProduto::create(['tip_nome' => 'Pastel Doce']);
        TipoProduto::create(['tip_nome' => 'Mini Pastelzinho']);
        TipoProduto::create(['tip_nome' => 'Mini Pastelzinho Doce']);
        TipoProduto::create(['tip_nome' => 'Tapioca Salgada']);
        TipoProduto::create(['tip_nome' => 'Tapioca Doce']);
        TipoProduto::create(['tip_nome' => 'Esfirra']);
        TipoProduto::create(['tip_nome' => 'Esfirra Doce']);
        TipoProduto::create(['tip_nome' => 'Açai Frooty']);
        
    }
}
