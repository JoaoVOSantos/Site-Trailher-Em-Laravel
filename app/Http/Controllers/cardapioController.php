<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\TipoProduto;
use Illuminate\Http\Request;

class cardapioController extends Controller
{
    public function index()
    {

        $produto = Produto::with('tipoproduto')->get();
        return view("cardapio.index",compact('produto'));
    }
}
