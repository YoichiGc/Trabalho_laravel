<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Exibe uma lista de autores com possibilidade de busca
     */
    public function index(Request $request)
    {
        // Inicia a query incluindo a contagem de livros de cada autor
        $query = Author::withCount('books');
        
        // Verifica se foi enviado um termo de busca
        if ($request->filled('search')) {
            $search = $request->search;
            $searchType = $request->get('search_type', 'name');
            
            // Define em qual campo será feita a busca baseado no tipo selecionado
            switch ($searchType) {
                case 'name':
                    $query->where('name', 'like', "%{$search}%");
                    break;
                case 'nationality':
                    $query->where('nationality', 'like', "%{$search}%");
                    break;
                case 'birth_date':
                    $query->where('birth_date', 'like', "%{$search}%");
                    break;
                case 'biography':
                    $query->where('biography', 'like', "%{$search}%");
                    break;
            }
        }
        
        // Executa a query com paginação (10 registros por página)
        $authors = $query->get();

        
        // Retorna a view com os autores
        return view('authors.list', compact('authors'));
    }

    /**
     * Exibe o formulário para criar um novo autor
     */
    public function create()
    {
        return view('authors.form');
    }

    /**
     * Salva um novo autor no banco de dados
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'biography' => 'nullable|string'
        ]);

        // Cria o novo autor com os dados validados
        Author::create($request->all());

        // Redireciona para a lista de autores com mensagem de sucesso
        return redirect()->route('authors.index')
            ->with('success', 'Autor criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um autor específico
     */
    public function show(Author $author)
    {
        // Retorna a view de detalhes do autor
        return view('authors.show', compact('author'));
    }

    /**
     * Exibe o formulário para editar um autor existente
     */
    public function edit(Author $author)
    {
        return view('authors.form', compact('author'));
    }

    /**
     * Atualiza os dados de um autor existente
     */
    public function update(Request $request, Author $author)
    {
        // Valida os dados recebidos do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'biography' => 'nullable|string'
        ]);

        // Atualiza o autor com os novos dados
        $author->update($request->all());

        // Redireciona para a lista de autores com mensagem de sucesso
        return redirect()->route('authors.index')
            ->with('success', 'Autor atualizado com sucesso!');
    }

    /**
     * Remove um autor do banco de dados
     */
    public function destroy(Author $author)
    {
        // Exclui o autor
        $author->delete();

        // Redireciona para a lista de autores com mensagem de sucesso
        return redirect()->route('authors.index')
            ->with('success', 'Autor excluído com sucesso!');
    }
}