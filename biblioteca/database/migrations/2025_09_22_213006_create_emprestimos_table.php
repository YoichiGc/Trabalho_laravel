<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('emprestimos')) {
            Schema::create('emprestimos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('livro_id')->constrained('livros');
                $table->string('nome_usuario');
                $table->date('data_emprestimo');
                $table->date('data_devolucao')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('emprestimos');
    }
};