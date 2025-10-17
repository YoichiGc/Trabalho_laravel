<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa (mass assignment)
     */
    protected $fillable = [
        'name',
        'nationality',
        'birth_date',
        'biography'
    ];

    /**
     * Converte os tipos de dados automaticamente
     */
    protected $casts = [
        'birth_date' => 'date', // Converte a string para objeto Carbon (data)
    ];

    /**
     * Define o relacionamento: um autor pode ter muitos livros
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}