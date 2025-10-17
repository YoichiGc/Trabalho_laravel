<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa a migração - cria a tabela de autores
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id(); // Chave primária auto-increment
            $table->string('name'); // Nome do autor (obrigatório)
            $table->string('nationality')->nullable(); // Nacionalidade (opcional)
            $table->date('birth_date')->nullable(); // Data de nascimento (opcional)
            $table->text('biography')->nullable(); // Biografia (opcional)
            $table->timestamps(); // created_at e updated_at automaticamente
        });
    }

    /**
     * Reverte a migração - exclui a tabela de autores
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
};