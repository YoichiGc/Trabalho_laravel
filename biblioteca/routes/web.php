<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

// Rota principal - página inicial do sistema
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas para os recursos (CRUDs) - geram automaticamente 7 rotas para cada controller
Route::resource('books', BookController::class);      // CRUD completo para livros
Route::resource('authors', AuthorController::class);  // CRUD completo para autores
Route::resource('categories', CategoryController::class); // CRUD completo para categorias

// Rota de fallback - redireciona qualquer rota não encontrada para a página inicial
Route::fallback(function () {
    return redirect()->route('home');
});