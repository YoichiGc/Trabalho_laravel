<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define os valores padrão para os atributos do model Book
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), // Gera um título com 3 palavras
            'isbn' => $this->faker->unique()->isbn13(), // Gera um ISBN único de 13 dígitos
            'publication_year' => $this->faker->year(), // Gera um ano aleatório
            'pages' => $this->faker->numberBetween(100, 500), // Número de páginas entre 100 e 500
            'description' => $this->faker->paragraph(), // Gera um parágrafo de descrição
            'author_id' => Author::factory(), // Cria um autor automaticamente ou usa existente
            'category_id' => Category::factory() // Cria uma categoria automaticamente ou usa existente
        ];
    }
}