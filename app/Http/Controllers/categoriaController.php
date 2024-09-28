<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; // Importando model categoria
class categoriaController extends Controller
{
    public function index(){
        //select * from categoria
        // $categorias = Categoria::all(); // == select * from
        $categorias = Categoria::where("cat_ativo", 1)->get();
        return view("categoria.index", compact("categorias"));
    }
    public function SalvarNovaCategoria(Request $request){
        $cat_nome = $request->input('cat_nome');
        $cat_descricao = $request->input('cat_descricao');
        // echo $cat_nome;
        
        $categoria = new Categoria();
        //          Pegando campo da tabela pelo model
        $categoria->cat_nome = $cat_nome;
        //                              // variavel sendo colocda no campo da tabela
        $categoria->cat_descricao = $cat_descricao;

        // Salvando
        $categoria->save();

        return redirect('/categoria');
    }

    public function ExcluirCategoria($id){
        // Select * from categoria where id = 1
        $categoria = Categoria::where("id", $id)->first();
        $categoria->cat_ativo = 0;
        $categoria->save();
        // Update categoria set cat_ativo=0 where id=1
        return redirect("/categoria");
    }

    // Delete
    // $categoria = Categoria::where("id", $id)->first();
    // $categoria->delete();



    public function BuscaAlterar($id){

        // pegando as informacoes com base no id
        $categoria = Categoria::where("id", $id)->first();
        // Passando as informacoes para uma view aterar
        return view('categoria.alterar', compact('categoria'));
    }

    public function SalvarAlteracao(Request $request){
        $nome = $request->input("cat_nome");
        $descricao = $request->input("cat_descricao");
        $id = $request->input("id");

        $categoria = Categoria::where("id",$id)->first();
        $categoria->cat_nome = $nome;
        $categoria->cat_descricao = $descricao;
        $categoria->save();
        return redirect("/categoria");
    }
}
