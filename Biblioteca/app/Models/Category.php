<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa (mass assignment)
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Define o relacionamento: uma categoria pode ter muitos livros
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}