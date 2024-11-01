<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class principalController extends Controller
{
    public function index()
    {
        // Obtenha os 3 produtos mais pedidos
        $produtosMaisPedidas = Produto::withCount('pedido')
        ->orderBy('pedido_count', 'desc') // Certifique-se de que isso está correto
        ->take(3)
        ->get();

        return view('principal.index', compact('produtosMaisPedidas'));
    }
}
