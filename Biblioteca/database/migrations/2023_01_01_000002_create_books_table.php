<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa a migração - cria a tabela de livros
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Chave primária auto-increment
            $table->string('title'); // Título do livro (obrigatório)
            $table->string('isbn')->unique(); // ISBN único (obrigatório e único)
            $table->integer('publication_year'); // Ano de publicação (obrigatório)
            $table->integer('pages'); // Número de páginas (obrigatório)
            $table->text('description')->nullable(); // Descrição (opcional)
            
            // Chave estrangeira para autores
            $table->foreignId('author_id')->constrained()->onDelete('restrict');
            
            // Chave estrangeira para categorias 
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            
            $table->timestamps(); // created_at e updated_at automaticamente
        });
    }

    /**
     * Reverte a migração - exclui a tabela de livros
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};