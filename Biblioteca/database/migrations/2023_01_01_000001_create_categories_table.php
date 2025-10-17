<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa a migração - cria a tabela de categorias
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Chave primária auto-increment
            $table->string('name'); // Nome da categoria (obrigatório)
            $table->text('description')->nullable(); // Descrição (opcional)
            $table->timestamps(); // created_at e updated_at automaticamente
        });
    }

    /**
     * Reverte a migração - exclui a tabela de categorias
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};