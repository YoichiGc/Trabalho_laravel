<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EmprestimoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('livros', LivroController::class);
Route::resource('autores', AutorController::class);
Route::resource('emprestimos', EmprestimoController::class);