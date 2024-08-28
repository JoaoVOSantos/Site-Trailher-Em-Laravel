<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');
    echo"Voce chegou qui";
});
Route::get('historia/', function(){
    return view('quemsomos.historia');
});

Route::get('produtos/', function(){
    echo "produtos";
});
// URL Base
// 127.0.0.1:8000


