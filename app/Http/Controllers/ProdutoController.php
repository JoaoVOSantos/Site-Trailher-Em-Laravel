<?php

namespace App\Http\Controllers;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // listagem de produto
    public function index()
    {
        $produtos = Produto::with('categoria')->get();

        $categorias = Categoria::all();

        return view('produto.index', compact('produtos','categorias'));
    }

    public function SalvarNovoProduto(Request $request)
    {

        // validacao doque o usuario digitou
        $request->validate([
            'cat_id' => 'required|exists:categoria,id',
            'prod_nome' => 'required|string|max:255',
            'prod_quantidade' => 'required|integer',
            'prod_descricao' => 'nullable|string',
        ]);

        Produto::create($request->all());
        return redirect()->route('produto_index')->with('success', 'Produto criado com sucesso!');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'cat_id' => 'required|exists:categorias,id',
            'prod_nome' => 'required|string|max:255',
            'prod_quantidade' => 'required|integer',
            'prod_descricao' => 'nullable|string',
        ]);

        $produto->update($request->all());
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso!');
    }
}
