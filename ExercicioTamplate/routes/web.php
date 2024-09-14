<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Base', function () {
    return view('layout.base');
});
Route::get('/Dashboard', function () {
    return view('Dashboard.index');
});
Route::get('/Colors', function () {
    return view('Colors.index');
});
Route::get('/Borders', function () {
    return view('borders.index');
});
Route::get('/Animations', function () {
    return view('Animations.index');
});
Route::get('/Other', function () {
    return view('Other.index');
});