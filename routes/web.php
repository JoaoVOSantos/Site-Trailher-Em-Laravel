<?php

use App\Http\Controllers\enderecoController;
use App\Http\Controllers\tipoprodutoController;
use App\Http\Controllers\usuarioController;
use Illuminate\Support\Facades\Route;
// Certo rota sempre chamar o controller
// Rota Layout Index
Route::get("/", function(){
    return view("admin_template.index");
});



Route::post('/usuario',[usuarioController::class,'SalvarNovoUsuario']);
Route::get('/usuario',[usuarioController::class,'index'])->name("usuario_index");
Route::get("/usuario/upd/{id}", [usuarioController::class, "BuscaAlterarUSU"])->name('usu_alterar');
Route::post("/usuario/upd",[usuarioController::class,"SalvarAlteracaoUSU"])->name('usu_alt_salva');
Route::get("/usuario/exc/{id}", [usuarioController::class, "ExcluirUSU"])->name('usu_excluir');


Route::get('/endereco',[enderecoController::class,'index'])->name("endereco_index");
Route::post('/endereco',[enderecoController::class,'SalvarNovoEndereco']);
Route::get("/endereco/upd/{id}", [enderecoController::class, "BuscaAlterarEND"])->name('end_alterar');
Route::post("/endereco/upd",[enderecoController::class,"SalvarAlteracaoEND"])->name('end_alt_salva');
Route::get("/endereco/exc/{id}", [enderecoController::class, "ExcluirEND"])->name('end_excluir');

Route::get("/tipoproduto", [tipoprodutoController::class, "index"])->name('tipoproduto_index');
Route::post("/tipoproduto", [tipoprodutoController::class, "SalvarNovoTipoProduto"]);
Route::get("/tipoproduto/upd/{id}", [tipoprodutoController::class, "BuscaAlterarTP"])->name('tip_alterar');
Route::post("/tipoproduto/upd",[tipoprodutoController::class,"SalvarAlteracaoTP"])->name('tip_alt_salva');
Route::get("/tipoproduto/exc/{id}", [tipoprodutoController::class, "ExcluirTP"])->name('tip_excluir');