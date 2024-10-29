<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class cardapioController extends Controller
{
    public function index()
    {
        $produto = Produto::all();
        return view("cardapio.index",compact('produto'));
    }
}
