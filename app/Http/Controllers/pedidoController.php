<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Pedido;
use App\Models\Usuario;
use Illuminate\Http\Request;

class pedidoController extends Controller
{
    public function index()
    {
        $pedido = Pedido::all();
        $usuario = Usuario::with('pedido')->get();
        $endereco = Endereco::with('usuario')->get();
        $usuarios = Usuario::all();


        return view('pedido.index', compact('pedido', 'usuario', 'endereco', 'usuarios'));
    }

    public function SalvarNovoPED(Request $request)
    {
        $request->validade([
                'usuario_id' => 'required|integer|exists:usuario,id', // Certifica que o ID do usuário existe na tabela users
                'ped_valor' => 'required|numeric|min:0', // Valor monetário não deve ser negativo
                'ped_status' => 'required|string|max:50', // Define um limite de caracteres para o status
                'ped_data' => 'required|date', // Verifica se é uma data válida
        ]);

        Pedido::create([
            
        ]);

        $usuario_id = $request->input('usuario_id');
        $ped_valor = $request->input('ped_valor');
        $ped_status = $request->input('ped_status');
        $ped_data = $request->input('ped_data');

        $pedido = new Pedido();
        $pedido->usuario_id = $usuario_id;
        $pedido->ped_valor = $ped_valor;
        $pedido->ped_status = $ped_status;
        $pedido->ped_data_pago = $ped_data;
        $totalPedidos = Pedido::where('usuario_id', $usuario_id)->count();


        $pedido->ped_quantidade = $totalPedidos + 1;
        $pedido->save();

        return redirect()->route('pedido_index')->with('success', 'Dados salvos com sucesso!');
    }

    public function ExcluirPED($id)
    {
        $pedido = Pedido::where('id', $id)->first();
        $pedido->delete();

        return redirect("/pedido");
    }

    public function BuscaAlterarPED($id)
    {
        $pedido = Pedido::where('id', $id)->first();
        $usuarios = Usuario::all();

        return view('pedido.alterar', compact('pedido', 'usuarios'));
    }
    public function SalvarAlteracaoPED(Request $request)
    {
        $usuario_id = $request->input('usuario_id');
        $ped_valor = $request->input('ped_valor');
        $ped_status = $request->input('ped_status');
        $ped_data = $request->input('ped_data');
        $id = $request->input("id");

        $pedido = PEdido::where('id', $id)->first();
        $pedido->usuario_id = $usuario_id;
        $pedido->ped_valor = $ped_valor;
        $pedido->ped_status = $ped_status;
        $pedido->ped_data_pago = $ped_data;
        $totalPedidos = Pedido::where('usuario_id', $usuario_id)->count();
        $pedido->ped_quantidade = $totalPedidos + 1;

        $pedido->save();

        return redirect("/pedido");
    }
}
