<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;
use App\Models\Produto;

class carrinhoController extends Controller
{
    public function adicionar(Request $request, $id)
    {
        // Encontra o produto pelo ID
        $produto = Produto::findOrFail($id);

        // Obtém o carrinho da sessão (ou cria um array vazio se não houver carrinho)
        $carrinho = session()->get('carrinho', []);

        // Adiciona o produto ao carrinho (usando o ID como chave para evitar duplicatas)
        if (!isset($carrinho[$id])) {
            $carrinho[$id] = [
                "pro_nome" => $produto->pro_nome,
                "pro_preco" => $produto->pro_preco,
                "quantidade" => 1,
            ];
        } else {
            // Incrementa a quantidade se o produto já estiver no carrinho
            $carrinho[$id]['quantidade']++;
        }

        // Atualiza o carrinho na sessão
        session()->put('carrinho', $carrinho);

        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    // Rota para exibir o carrinho, vou usar quando chamar a pagina
    public function mostrarCarrinho()
    {
        $carrinho = session()->get('carrinho');
        $ingrediente = Ingrediente::with('produto')->get();
        $produto = Produto::with('tipoproduto')->get();
        return view('carrinho.index', compact('carrinho', 'produto', 'ingrediente'));
    }

    //funcao que remove o item do carrinho
    public function update($id)
    {
        $carrinho = session()->get('carrinho');

        // Verifica se o item existe no carrinho
        if (isset($carrinho[$id])) {
            // Reduz a quantidade
            $carrinho[$id]['quantidade']--;

            // Remove o item se a quantidade chegar a zero
            if ($carrinho[$id]['quantidade'] <= 0) {
                unset($carrinho[$id]);
            }

            session()->put('carrinho', $carrinho);
        }

        return redirect()->route('carrinho');
    }
    public function add($id)
    {
        $carrinho = session()->get('carrinho');

        // Verifica se o item existe no carrinho
        if (isset($carrinho[$id])) {
            // Reduz a quantidade
            $carrinho[$id]['quantidade']++;

            // Remove o item se a quantidade chegar a zero
            if ($carrinho[$id]['quantidade'] <= 0) {
                unset($carrinho[$id]);
            }

            session()->put('carrinho', $carrinho);
        }

        return redirect()->route('carrinho');
    }
}
