<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $fillable = ['livro_id', 'nome_usuario', 'data_emprestimo', 'data_devolucao'];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }
}