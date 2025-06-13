<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\cardapioController;
use App\Http\Controllers\enderecoController;
use App\Http\Controllers\ingredienteController;
use App\Http\Controllers\pedidoController;
use App\Http\Controllers\principalController;
use App\Http\Controllers\produtoController;
use App\Http\Controllers\tipoprodutoController;
use App\Http\Controllers\usuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\carrinhoController;
use App\Http\Controllers\PagamentoController;

/*
view -> o caminho das pastas ex: cliente.metas.index
route -> o caminho que os forms e as urls vao fazer ex: form({{route('cliente')}})  route()->name('cliente');
controller ->ele vem da rota e retorna uma rota ou uma view depois de executar a logica
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get("/administrador", function () {
        return view("admin_template.index");
    })->name('administrador');

    Route::post('/usuario', [usuarioController::class, 'SalvarNovoUsuario']);
    Route::get('/usuario', [usuarioController::class, 'index'])->name("usuario_index");
    Route::get("/usuario/upd/{id}", [usuarioController::class, "BuscaAlterarUSU"])->name('usu_alterar');
    Route::post("/usuario/upd", [usuarioController::class, "SalvarAlteracaoUSU"])->name('usu_alt_salva');
    Route::get("/usuario/exc/{id}", [usuarioController::class, "ExcluirUSU"])->name('usu_excluir');

    Route::get('/endereco', [enderecoController::class, 'index'])->name("endereco_index");
    Route::post('/endereco', [enderecoController::class, 'SalvarNovoEndereco']);
    Route::get("/endereco/upd/{id}", [enderecoController::class, "BuscaAlterarEND"])->name('end_alterar');
    Route::post("/endereco/upd", [enderecoController::class, "SalvarAlteracaoEND"])->name('end_alt_salva');
    Route::get("/endereco/exc/{id}", [enderecoController::class, "ExcluirEND"])->name('end_excluir');

    Route::get("/tipoproduto", [tipoprodutoController::class, "index"])->name('tipoproduto_index');
    Route::post("/tipoproduto", [tipoprodutoController::class, "SalvarNovoTipoProduto"]);
    Route::get("/tipoproduto/upd/{id}", [tipoprodutoController::class, "BuscaAlterarTP"])->name('tip_alterar');
    Route::post("/tipoproduto/upd", [tipoprodutoController::class, "SalvarAlteracaoTP"])->name('tip_alt_salva');
    Route::get("/tipoproduto/exc/{id}", [tipoprodutoController::class, "ExcluirTP"])->name('tip_excluir');

    Route::get("/produto", [produtoController::class, "index"])->name('produto_index');
    Route::get("/produto/upd/{id}", [produtoController::class, "BuscaAlterarPRO"])->name('pro_alterar');
    Route::get("/produto/exc/{id}", [produtoController::class, "ExcluirPRO"])->name('pro_excluir');
    Route::post("/produto", [produtoController::class, "SalvarNovoProduto"]);
    Route::post("/produto/upd", [produtoController::class, "SalvarAlteracaoPRO"])->name('pro_alt_salva');

    Route::get("/ingrediente", [ingredienteController::class, "index"])->name('ingrediente_index');
    Route::post("/ingrediente", [ingredienteController::class, "SalvarNovoING"]);
    Route::get("/ingrediente/upd/{id}", [ingredienteController::class, "BuscaAlterarING"])->name('ing_alterar');
    Route::get("/ingrediente/exc/{id}", [ingredienteController::class, "ExcluirING"])->name('ing_excluir');
    Route::post("/ingrediente/upd", [ingredienteController::class, "SalvarAlteracaoING"])->name('ing_alt_salva');

    Route::get("/pedido", [pedidoController::class, "index"])->name('pedido_index');
    Route::post("/pedido", [pedidoController::class, "SalvarNovoPED"]);
    Route::get("/pedido/upd/{id}", [pedidoController::class, "BuscaAlterarPED"])->name('ped_alterar');
    Route::get("/pedido/exc/{id}", [pedidoController::class, "ExcluirPED"])->name('ped_excluir');
    Route::post("/pedido/upd", [pedidoController::class, "SalvarAlteracaoPED"])->name('ped_alt_salva');




});
    
// Rota Teste
Route::get("/", function () {
    return view("cliente_template.index");
})->name('cliente');

route::get("/principal", [principalController::class, "index"])->name('principal');
route::get("/cardapio", [cardapioController::class, "index"])->name('cardapio');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth'])->group(function () {

    Route::get('/logout', [AuthController::class, 'showlogoutForm'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/areacliente', [usuarioController::class, 'mostrarAreaCliente'])->name('mostrarAreaCliente');
    Route::post('/areacliente/endereco', [usuarioController::class, 'SalvarNovoEndereco'])->name('SalvarNovoEndereco');
    Route::post('/areacliente/usuario', [usuarioController::class, 'salvarNovosDados'])->name('salvarNovosDados');


    // Rota do carrinho feito com gpt, porem não é diferente de qualquer outra rota que ja tenha feito
    Route::get('/adicionar-ao-carrinho/{id}', [carrinhoController::class, 'adicionar'])->name('adicionar.carrinho');
    Route::patch('/carrinho/update/{id}', [carrinhoController::class, 'update'])->name('carrinho.update');
    Route::patch('/carrinho/update/add/{id}', [carrinhoController::class, 'add'])->name('carrinho.add');
    Route::get('/carrinho', [carrinhoController::class, 'mostrarCarrinho'])->name('carrinho');


    Route::post('/mercadopago/create', [PagamentoController::class, 'createPaymentPreference'])->name('mercadopago.create');
    Route::get('/mercadopago/success', [PagamentoController::class, 'paymentSuccess'])->name('mercadopago.success');
    Route::get('/voltarCarrinho', [carrinhoController::class, 'index'])->name('voltarCarrinho');

    Route::get('/sobre',[principalController::class, 'sobre'])->name('sobre');


    Route::get('/mercadopago/failure', function () {
        return "Falha no pagamento!";
    })->name('mercadopago.failure');

});
