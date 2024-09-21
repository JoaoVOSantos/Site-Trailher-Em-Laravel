<?php

use App\Http\Controllers\categoriaController;
use Illuminate\Support\Facades\Route;
// Certo rota sempre chamar o controller
// Rota Layout Index
Route::get("/", function(){
    return view("admin_template.index");
});

// Rota do Conteudo categoria                     Puxando Classe   Função index
Route::get("/categoria", [categoriaController::class, "index"]);

// Rota do Conteudo produto
Route::get("/produto", function(){
    return view("produto.index");
});