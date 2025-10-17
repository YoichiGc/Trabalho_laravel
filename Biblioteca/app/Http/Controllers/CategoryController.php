<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Exibe uma lista de categorias com possibilidade de busca
     */
    public function index(Request $request)
    {
        // Inicia a query incluindo a contagem de livros de cada categoria
        $query = Category::withCount('books');
        
        // Verifica se foi enviado um termo de busca
        if ($request->filled('search')) {
            $search = $request->search;
            $searchType = $request->get('search_type', 'name');
            
            // Define em qual campo será feita a busca baseado no tipo selecionado
            switch ($searchType) {
                case 'name':
                    $query->where('name', 'like', "%{$search}%");
                    break;
                case 'description':
                    $query->where('description', 'like', "%{$search}%");
                    break;
            }
        }
        
        // Executa a query com paginação (10 registros por página)
        $categories = $query->paginate(10);
        
        // Retorna a view com as categorias
        return view('categories.list', compact('categories'));
    }

    /**
     * Exibe o formulário para criar uma nova categoria
     */
    public function create()
    {
        return view('categories.form');
    }

    /**
     * Salva uma nova categoria no banco de dados
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        // Cria a nova categoria com os dados validados
        Category::create($request->all());

        // Redireciona para a lista de categorias com mensagem de sucesso
        return redirect()->route('categories.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Exibe os detalhes de uma categoria específica
     */
    public function show(Category $category)
    {
        // Carrega os livros da categoria junto com seus autores
        $category->load('books.author');
        
        // Retorna a view de detalhes da categoria
        return view('categories.show', compact('category'));
    }

    /**
     * Exibe o formulário para editar uma categoria existente
     */
    public function edit(Category $category)
    {
        return view('categories.form', compact('category'));
    }

    /**
     * Atualiza os dados de uma categoria existente
     */
    public function update(Request $request, Category $category)
    {
        // Valida os dados recebidos do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        // Atualiza a categoria com os novos dados
        $category->update($request->all());

        // Redireciona para a lista de categorias com mensagem de sucesso
        return redirect()->route('categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove uma categoria do banco de dados
     */
    public function destroy(Category $category)
    {
        // Exclui a categoria
        $category->delete();

        // Redireciona para a lista de categorias com mensagem de sucesso
        return redirect()->route('categories.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}