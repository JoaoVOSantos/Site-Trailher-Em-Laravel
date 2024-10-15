<?php

use App\Http\Controllers\categoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;
// Certo rota sempre chamar o controller
// Rota Layout Index
Route::get("/", function(){
    return view("admin_template.index");
});

// Categoria
// Rota do Conteudo categoria                     Puxando Classe   Função index
Route::get("/categoria", [categoriaController::class, "index"]);
Route::post("/categoria", [categoriaController::class,"SalvarNovaCategoria"]);
Route::post("categoria/udp",[categoriaController::class,"SalvarAlteracao"])->name('cat_alt_salva');
Route::get('/categoria/upd/{id}', [categoriaController::class, "BuscaAlterar"])->name('cat_alterar');
Route::get('/categoria/exc/{id}', [categoriaController::class, "ExcluirCategoria"])->name('cat_excluir');

//Produto
Route::get('/produto',[ProdutoController::class, 'index'])->name('produto_index');                     
Route::post('/produto',[ProdutoController::class, 'SalvarNovoProduto'])->name('produto_novo');
Route::get('/produto/exc/{id}', [ProdutoController::class, "ExcluirProduto"])->name('prod_excluir');
Route::get('/produto/upd/{id}', [ProdutoController::class, "BuscaAlterar"])->name('prod_alterar');
Route::post("produto/udp",[ProdutoController::class,"SalvarAlteracao"])->name('prod_alt_salva');