<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;

class ingredienteController extends Controller
{
    public function index(){
        $ingrediente = Ingrediente::all();

        return view('ingrediente.index',compact('ingrediente'));
    }

    public function SalvarNovoING(Request $request){
        $ing_nome = $request->input('ing_nome');

        $ingrediente = new Ingrediente();
        $ingrediente->ing_nome = $ing_nome;
        $ingrediente->save();        

        return redirect('/ingrediente');
    }

    public function ExcluirING($id){
        $ingrediente = Ingrediente::where('id', $id)->first();

        $ingrediente->delete();

        return redirect('/ingrediente');
    }

    public function BuscaAlterarING($id){
        $ingrediente = Ingrediente::where('id', $id)->first();
        
        Return view('ingrediente.alterar',compact('ingrediente'));
    }

    public function SalvarAlteracaoING(Request $request){
        $id = $request->input('id');
        $ing_nome = $request->input('ing_nome');

        $ingrediente = Ingrediente::where('id', $id)->first();
        $ingrediente->ing_nome = $ing_nome;
        $ingrediente->save();

        return redirect('/ingrediente');
    }
}