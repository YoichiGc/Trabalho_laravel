<?php
// database/factories/EmprestimoFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmprestimoFactory extends Factory
{
    public function definition()
    {
        return [
            'livro_id' => \App\Models\Livro::factory(),
            'nome_usuario' => $this->faker->name,
            'data_emprestimo' => $this->faker->date(),
            'data_devolucao' => $this->faker->optional()->date(),
        ];
    }
}