<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Exibe uma lista de livros com possibilidade de busca
     */
    public function index(Request $request)
    {
        // Inicia a query carregando os relacionamentos com autor e categoria
        $query = Book::with(['author', 'category']);
        
        // Verifica se foi enviado um termo de busca
        if ($request->filled('search')) {
            $search = $request->search;
            $searchType = $request->get('search_type', 'title');
            
            // Define em qual campo será feita a busca baseado no tipo selecionado
            switch ($searchType) {
                case 'title':
                    $query->where('title', 'like', "%{$search}%");
                    break;
                case 'isbn':
                    $query->where('isbn', 'like', "%{$search}%");
                    break;
                case 'author':
                    // Busca pelo nome do autor usando o relacionamento
                    $query->whereHas('author', function($authorQuery) use ($search) {
                        $authorQuery->where('name', 'like', "%{$search}%");
                    });
                    break;
                case 'category':
                    // Busca pelo nome da categoria usando o relacionamento
                    $query->whereHas('category', function($categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', "%{$search}%");
                    });
                    break;
                case 'publication_year':
                    $query->where('publication_year', 'like', "%{$search}%");
                    break;
                case 'description':
                    $query->where('description', 'like', "%{$search}%");
                    break;
            }
        }
        
        // Executa a query com paginação (10 registros por página)
        $books = $query->paginate(150);
        
        // Retorna a view com os livros
        return view('books.list', compact('books'));
    }

    /**
     * Exibe o formulário para criar um novo livro
     */
    public function create()
    {
        // Busca todos os autores e categorias para popular os selects do formulário
        $authors = Author::all();
        $categories = Category::all();
        
        return view('books.form', compact('authors', 'categories'));
    }

    /**
     * Salva um novo livro no banco de dados
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos do formulário
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'publication_year' => 'required|integer|min:1000|max:' . date('Y'),
            'pages' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        // Cria o novo livro com os dados validados
        Book::create($request->all());

        // Redireciona para a lista de livros com mensagem de sucesso
        return redirect()->route('books.index')
            ->with('success', 'Livro criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um livro específico
     */
    public function show(Book $book)
    {
        // Carrega os relacionamentos do livro (autor e categoria)
        $book->load(['author', 'category']);
        
        // Retorna a view de detalhes do livro
        return view('books.show', compact('book'));
    }

    /**
     * Exibe o formulário para editar um livro existente
     */
    public function edit(Book $book)
    {
        // Busca todos os autores e categorias para popular os selects do formulário
        $authors = Author::all();
        $categories = Category::all();
        
        return view('books.form', compact('book', 'authors', 'categories'));
    }

    /**
     * Atualiza os dados de um livro existente
     */
    public function update(Request $request, Book $book)
    {
        // Valida os dados recebidos do formulário
        // O unique no ISBN ignora o registro atual para permitir a atualização
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'publication_year' => 'required|integer|min:1000|max:' . date('Y'),
            'pages' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        // Atualiza o livro com os novos dados
        $book->update($request->all());

        // Redireciona para a lista de livros com mensagem de sucesso
        return redirect()->route('books.index')
            ->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Remove um livro do banco de dados
     */
    public function destroy(Book $book)
    {
        // Exclui o livro
        $book->delete();

        // Redireciona para a lista de livros com mensagem de sucesso
        return redirect()->route('books.index')
            ->with('success', 'Livro excluído com sucesso!');
    }
}