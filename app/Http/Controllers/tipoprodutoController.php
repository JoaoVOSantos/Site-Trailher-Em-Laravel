<?php

namespace App\Http\Controllers;

use App\Models\TipoProduto;
use Illuminate\Http\Request;

class tipoprodutoController extends Controller
{
    public function index(){

        $tipoprodutos = TipoProduto::all();

        return view("tipoproduto.index", compact('tipoprodutos'));
    }

    public function SalvarNovoTipoProduto(Request $request){
        $tip_nome = $request->input('tip_nome');

        $tipoproduto = new TipoProduto();

        $tipoproduto->tip_nome = $tip_nome;

        $tipoproduto->save();

        return redirect('/tipoproduto');
    }

    public function ExcluirTP($id){
        $tipoproduto = TipoProduto::where('id',$id)->first();
        $tipoproduto->delete();
        return redirect()->route('tipoproduto_index')->with('success', 'Produto removido com sucesso!');
    }

    public function BuscaAlterarTP($id){
        $tipoproduto = TipoProduto::where('id',$id)->first();
        return view('tipoproduto.alterar',compact('tipoproduto'));  
    }

    public function SalvarAlteracaoTP(Request $request){
        $tip_nome = $request->input("tip_nome");
        $id = $request->input("id");

        $tipoproduto = TipoProduto::where('id',$id)->first();
        $tipoproduto->tip_nome = $tip_nome;
        $tipoproduto->save();
        return redirect("/tipoproduto");
    }
}
