<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Pedido;
use App\Models\Usuario;
use Illuminate\Http\Request;

class pedidoController extends Controller
{
    public function index(){
        $pedido = Pedido::all();
        $usuario = Usuario::with('pedido')->get();
        $endereco = Endereco::with('usuario')->get();
        

        return view('pedido.index',compact('pedido','usuario','endereco'));
    }
}
