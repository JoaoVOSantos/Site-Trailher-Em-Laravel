<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class usuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('endereco')->get();
        $enderecos = Endereco::with('usuario')->get();

        return view("usuario.index", compact('usuarios', 'enderecos'));
    }

    public function SalvarNovoUsuario(Request $request)
    {

        $usu_nome = $request->input('usu_nome');
        $usu_senha = $request->input('usu_senha');
        $usu_email = $request->input('usu_email');
        $usu_admin = $request->input('usu_admin');

        $usuario = new Usuario();
        $usuario->usu_nome = $usu_nome;
        $usuario->usu_senha = Hash::make($usu_senha);
        $usuario->usu_email = $usu_email;
        $usuario->usu_admin = $usu_admin;
        $usuario->save();

        $end_ids = $request->input('end_id');
        $usuario->endereco()->attach($end_ids);


        return redirect('/usuario')->with('success', 'Usuário criado com sucesso!');;
    }

    public function ExcluirUSU($id)
    {
        $usuario = Usuario::where('id', $id)->first();
        $usuario->delete();

        return redirect("/usuario");
    }

    public function BuscaAlterarUSU($id)
    {
        $usuario = Usuario::where('id', $id)->first();
        $enderecos = Endereco::with('usuario')->get();
        return view("usuario.alterar", compact('usuario', 'enderecos'));
    }

    public function SalvarAlteracaoUSU(Request $request)
    {
        $usu_nome = $request->input('usu_nome');
        $usu_senha = $request->input('usu_senha');
        $usu_email = $request->input('usu_email');
        $usu_admin = $request->input('usu_admin');
        $id = $request->input("id");

        $usuarios = Usuario::where('id', $id)->first();

        $usuarios->usu_nome = $usu_nome;
        $usuarios->usu_senha = Hash::make($usu_senha);
        $usuarios->usu_email = $usu_email;
        $usuarios->usu_admin = $usu_admin;

        $usuarios->save();

        $end_ids = $request->input('end_id');
        $usuarios->endereco()->sync($end_ids);

        return redirect("/usuario");
    }

    public function mostrarAreaCliente()
    {
        $user = Auth::id();

        $usuario = Usuario::where('id', $user)->first();
        $enderecos = Endereco::with('usuario')->get();
        $enderecos_all = Endereco::all();


        return view('cliente.areacliente.index', compact('usuario', 'enderecos', 'enderecos_all'));
    }

    public function salvarNovosDados(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'usu_nome' => 'required|string|max:255',
            'usu_senha' => 'nullable|string|min:6|confirmed', // Confirmar a senha
            'usu_email' => 'required|email|max:255|unique:usuario,usu_email,' . Auth::id(),
            'end_id' => 'array', // Validar que é um array
            'end_id.*' => 'exists:endereco,id', // Verifica se os IDs existem na tabela de endereços
            'id' => 'required|exists:usuario,id',
        ]);

   
        $usuario = Usuario::where('id', Auth::user()->id)->first();
        
        
        $usu_nome = $request->input('usu_nome');
        $usuario->usu_nome = $usu_nome;

        // Atualiza a senha se fornecida
        if ($request->usu_senha) {
            $usuario->password = Hash::make($request->usu_senha);
        }

        $usuario->usu_email = $request->usu_email;
        $usuario->save();

        // Atualiza os endereços do usuário
        $usuario->endereco()->sync($request->end_id); // Sincroniza os endereços selecionados

        return redirect()->route('mostrarAreaCliente')->with('success', 'Dados do usuário atualizados com sucesso!');
    }

    public function SalvarNovoEndereco(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'end_rua' => 'required|string|max:255',
            'end_numero' => 'required|integer',
            'end_bairro' => 'required|string|max:255',
            'end_cep' => 'required|string|max:10',
            'end_complemento' => 'nullable|string|max:255',
        ]);

        // Criação de um novo endereço
        $endereco = new Endereco(); // Substitua pelo seu modelo de Endereco
        $endereco->end_rua = $request->end_rua;
        $endereco->end_numero = $request->end_numero;
        $endereco->end_bairro = $request->end_bairro;
        $endereco->end_cep = $request->end_cep;
        $endereco->end_complemento = $request->end_complemento;
        $endereco->save();

        // Associar o novo endereço ao usuário logado
        $idUsuario = Auth::user()->id;
        $usuarioCerto = Usuario::where('id', $idUsuario)->first();

        $usuarioCerto->endereco()->attach($endereco->id); // Certifique-se de que a relação esteja configurada corretamente

        return redirect()->route('mostrarAreaCliente')->with('success', 'Endereço cadastrado com sucesso!');
    }
}
