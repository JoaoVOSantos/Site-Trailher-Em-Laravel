<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class principalController extends Controller
{
    public function index(){
        $produto = Produto::all()->take(3);

        return view('principal.index',compact('produto'));
    }
}
