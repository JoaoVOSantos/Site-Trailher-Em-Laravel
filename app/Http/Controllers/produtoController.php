<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use App\Models\Ingredienteativo;
use App\Models\Produto;
use App\Models\TipoProduto;
use Illuminate\Http\Request;

class produtoController extends Controller
{
    public function index()
    {
        $produto = Produto::all();
        $ingrediente = Ingredienteativo::all();
        $ingrediente_todos = Ingrediente::all();
        $tipoproduto_todos = TipoProduto::all(); //para o modal
        $tipoproduto = TipoProduto::with('produto')->get(); //para a tabela

        return view('produto.index', compact('produto', 'tipoproduto', 'ingrediente', 'tipoproduto_todos', 'ingrediente_todos'));
    }
    public function SalvarNovoProduto(Request $request)
    {
        $pro_nome = $request->input('pro_nome');
        $pro_preco = $request->input('pro_preco');
        $pro_descricao = $request->input('pro_descricao');
        $tip_id = $request->input('tip_id');

        $produto = new Produto();
        $produto->pro_nome = $pro_nome;
        $produto->pro_preco = $pro_preco;
        $produto->pro_descricao = $pro_descricao;
        $produto->tip_id = $tip_id;
        $produto->save();

        $ingrediente_ids = $request->input('ingrediente_id');

        if ($ingrediente_ids) {
            foreach ($ingrediente_ids as $ingrediente_id) {
                $produto->ingrediente()->attach($ingrediente_id, ['ativo' => true]);
            }
        }

        return redirect('/produto');
    }

    public function ExcluirPRO($id)
    {
        $produto = Produto::where('id', $id)->first();
        $produto->delete();

        return redirect('/produto');
    }

    public function BuscaAlterarPRO($id)
    {
        $produto = Produto::where('id', $id)->first();
        $tiposprodutos = TipoProduto::with('produto')->get();
        $ingredientes = Ingrediente::with('produto')->get();


        return view('produto.alterar', compact('produto', 'tiposprodutos', 'ingredientes'));
    }
    public function SalvarAlteracaoPRO(Request $request)
    {
        $pro_nome = $request->input('pro_nome');
        $pro_preco = $request->input('pro_preco');
        $pro_descricao = $request->input('pro_descricao');
        $tip_id = $request->input('tip_id');
        $id = $request->input("id");

        $produto = Produto::where('id', $id)->first();
        $produto->pro_nome = $pro_nome;
        $produto->pro_preco = $pro_preco;
        $produto->pro_descricao = $pro_descricao;
        $produto->tip_id = $tip_id;
        $produto->save();

        $ingrediente_ids = $request->input('ingrediente_id');

        $ingredientesAtivos = [];

        if ($ingrediente_ids) {
            foreach ($ingrediente_ids as $ingrediente_id) {
                $ingredientesAtivos[$ingrediente_id] = ['ativo' => true]; // Define como ativo
            }
        }   

        $produto->ingrediente()->sync($ingredientesAtivos);

        return redirect('/produto');
    }
}
