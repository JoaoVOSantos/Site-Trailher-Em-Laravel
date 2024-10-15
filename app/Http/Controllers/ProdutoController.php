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

    public function ExcluirProduto($id){
        // Select * from categoria where id = 1
        $produtos = Produto::where("id", $id)->first();
        $produtos->delete();
        return redirect()->route('produto_index')->with('success', 'Produto removido com sucesso!');
    }

    public function BuscaAlterar($id){

        // pegando as informacoes com base no id
        $produtos = Produto::where("id", $id)->first();
        $categorias = Categoria::where("cat_ativo", 1)->get();
        // Passando as informacoes para uma view aterar
        return view('produto.alterar', compact('produtos', 'categorias'));
    }

    public function SalvarAlteracao(Request $request){
        $nome = $request->input("prod_nome");
        $descricao = $request->input("prod_descricao");
        $categoria = $request->input('cat_id');
        $id = $request->input("id");

        $produto = Produto::where("id",$id)->first();
        $produto->prod_nome = $nome;
        $produto->prod_descricao = $descricao;
        $produto->cat_id = $categoria;
        $produto->save();
        return redirect("/produto");
    }
}
