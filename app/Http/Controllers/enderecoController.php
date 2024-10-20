<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class enderecoController extends Controller
{
    public function index(){

        $endereco = Endereco::all();

        return view("endereco.index", compact('endereco'));
    }
    public function SalvarNovoEndereco(Request $request){
        $end_rua = $request->input('end_rua');
        $end_numero = $request->input('end_numero');
        $end_bairro = $request->input('end_bairro');
        $end_cep = $request->input('end_cep');
        $end_complemento = $request->input('end_complemento');

        $endereco = new Endereco();
        
        $endereco->end_rua = $end_rua;
        $endereco->end_numero = $end_numero;
        $endereco->end_bairro = $end_bairro;
        $endereco->end_cep = $end_cep;
        $endereco->end_complemento = $end_complemento;

        $endereco->save();
        return redirect('/endereco');

    }

    public function BuscaAlterarEND($id){
        $endereco = Endereco::where("id", $id)->first();
        return view('endereco.alterar',compact('endereco'));
    }

    public function ExcluirEND($id){
        $endereco = Endereco::where("id", $id)->first();

        $endereco->delete();
        return redirect("/endereco");
    }

    public function SalvarAlteracaoEND(Request $request){
        $id = $request->input("id");
        $end_rua = $request->input('end_rua');
        $end_numero = $request->input('end_numero');
        $end_bairro = $request->input('end_bairro');
        $end_cep = $request->input('end_cep');
        $end_complemento = $request->input('end_complemento');

        $endereco = Endereco::where('id',$id)->first();

        $endereco->end_rua = $end_rua;
        $endereco->end_numero = $end_numero;
        $endereco->end_bairro = $end_bairro;
        $endereco->end_cep = $end_cep;
        $endereco->end_complemento = $end_complemento;

        $endereco->save();
        return redirect("/endereco");
    }
}
