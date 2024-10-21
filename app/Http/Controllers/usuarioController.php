<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Http\Request;

class usuarioController extends Controller
{
    public function index(){
        
        $endereco = Endereco::with('usuario')->get();
        $usuarios = Usuario::with('endereco')->get();

    return view("usuario.index", compact('usuarios','endereco'));
}

}
