<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Http\Request;

class usuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('endereco')->get();
        $enderecos = Endereco::with('usuario')->get();

        return view("usuario.index", compact('usuarios', 'enderecos'));
    }

    public function SalvarNovoUsuario(Request $request) {

        $usu_nome = $request->input('usu_nome');
        $usu_senha = $request->input('usu_senha');
        $usu_email = $request->input('usu_email');
        $usu_admin = $request->input('usu_admin');
        
        $usuario = new Usuario();
        $usuario->usu_nome = $usu_nome;
        $usuario->usu_senha = $usu_senha;
        $usuario->usu_email = $usu_email;
        $usuario->usu_admin = $usu_admin;
        $usuario->save();

        $end_ids = $request->input('end_id');
        $usuario->endereco()->attach($end_ids);


        return redirect('/usuario')->with('success', 'Usuário criado com sucesso!');;
    }

    public function ExcluirUSU($id){
        $usuario = Usuario::where('id',$id)->first();
        $usuario->delete();

        return redirect("/usuario");
    }

    public function BuscaAlterarUSU($id){
        $usuario = Usuario::where('id',$id)->first();
        $enderecos = Endereco::with('usuario')->get();
        return view("usuario.alterar", compact('usuario','enderecos'));
    }

    public function SalvarAlteracaoUSU(Request $request){
        $usu_nome = $request->input('usu_nome');
        $usu_senha = $request->input('usu_senha');
        $usu_email = $request->input('usu_email');
        $usu_admin = $request->input('usu_admin');
        $id = $request->input("id");

        $usuarios = Usuario::where('id',$id)->first();

        $usuarios->usu_nome = $usu_nome;
        $usuarios->usu_senha = $usu_senha;
        $usuarios->usu_email = $usu_email;
        $usuarios->usu_admin = $usu_admin;

        $usuarios->save();
   
        $end_ids = $request->input('end_id');
        $usuarios->endereco()->sync($end_ids);

        return redirect("/usuario");
        
    }
}
