<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'autor_id', 'ano_publicacao'];

    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}