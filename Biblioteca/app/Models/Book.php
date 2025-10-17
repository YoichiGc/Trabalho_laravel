<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa (mass assignment)
     */
    protected $fillable = [
        'title',
        'isbn', 
        'publication_year',
        'pages',
        'description',
        'author_id',      // Chave estrangeira para o autor
        'category_id'     // Chave estrangeira para a categoria
    ];

    /**
     * Converte os tipos de dados automaticamente
     */
    protected $casts = [
        'publication_year' => 'integer', // Garante que seja um número inteiro
        'pages' => 'integer',            // Garante que seja um número inteiro
    ];

    /**
     * Define o relacionamento: um livro pertence a um autor
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Define o relacionamento: um livro pertence a uma categoria
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}