<?php
// database/factories/LivroFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LivroFactory extends Factory
{
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'autor_id' => \App\Models\Autor::factory(),
            'ano_publicacao' => $this->faker->year,
        ];
    }
}