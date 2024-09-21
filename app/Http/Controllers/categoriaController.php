<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; // Importando model categoria
class categoriaController extends Controller
{
    public function index(){
        //select * from categoria
        $categorias = Categoria::all(); // == select * from
        return view("categoria.index", compact("categorias"));
    }
}
