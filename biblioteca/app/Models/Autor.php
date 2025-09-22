<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    // 🔥 CORRIGIR: Especificar o nome da tabela
    protected $table = 'autores';

    protected $fillable = ['nome', 'nacionalidade'];

    public function livros()
    {
        return $this->hasMany(Livro::class);
    }
}