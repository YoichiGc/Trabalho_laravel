<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define os valores padrão para os atributos do model Category
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // Gera uma palavra aleatória para o nome
            'description' => $this->faker->sentence() // Gera uma frase aleatória para a descrição
        ];
    }
}