<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AuthorFactory extends Factory
{
    /**
     * Especifica qual model esta factory representa
     */
    protected $model = Author::class;

    /**
     * Define os valores padrão para os atributos do model Author
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(), // Gera um nome aleatório
            'nationality' => $this->faker->country(), // Gera um país aleatório
            'birth_date' => $this->faker->dateTimeBetween('-80 years', '-20 years')->format('Y-m-d'), // Data entre 80 e 20 anos atrás
            'biography' => $this->faker->paragraphs(3, true), // Gera 3 parágrafos de biografia
            'created_at' => Carbon::now(), // Data e hora atual
            'updated_at' => Carbon::now(), // Data e hora atual
        ];
    }
}