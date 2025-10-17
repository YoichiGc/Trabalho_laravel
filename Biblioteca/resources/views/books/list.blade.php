@extends('layouts.app')

@section('title', 'Listagem de Livros')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📖 Listagem de Livros</h2>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Livro
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('books.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="search_type" class="form-label">Buscar por:</label>
                <select class="form-select" name="search_type" id="search_type">
                    <option value="title" {{ request('search_type') == 'title' || !request('search_type') ? 'selected' : '' }}>Título</option>
                    <option value="isbn" {{ request('search_type') == 'isbn' ? 'selected' : '' }}>ISBN</option>
                    <option value="author" {{ request('search_type') == 'author' ? 'selected' : '' }}>Autor</option>
                    <option value="category" {{ request('search_type') == 'category' ? 'selected' : '' }}>Categoria</option>
                    <option value="publication_year" {{ request('search_type') == 'publication_year' ? 'selected' : '' }}>Ano de Publicação</option>
                    <option value="description" {{ request('search_type') == 'description' ? 'selected' : '' }}>Descrição</option>
                </select>
            </div>
            <div class="col-md-7">
                <label for="search" class="form-label">Termo de busca:</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" name="search" id="search"
                           value="{{ request('search') }}" 
                           placeholder="Digite o termo de busca...">
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(request()->filled('search'))

@endif

@if($books->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover border-0">
            <thead class="table-dark">
                <tr>
                    <th class="border-0">ID</th>
                    <th class="border-0">Título</th>
                    <th class="border-0">ISBN</th>
                    <th class="border-0">Autor</th>
                    <th class="border-0">Categoria</th>
                    <th class="border-0">Ano</th>
                    <th class="border-0">Páginas</th>
                    <th class="border-0">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td class="border-0">{{ $book->id }}</td>
                    <td class="border-0">{{ $book->title }}</td>
                    <td class="border-0">{{ $book->isbn }}</td>
                    <td class="border-0">{{ $book->author->name }}</td>
                    <td class="border-0">{{ $book->category->name }}</td>
                    <td class="border-0">{{ $book->publication_year }}</td>
                    <td class="border-0">{{ $book->pages }}</td>
                    <td class="border-0">
                        <div class="btn-group" role="group">
            
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@else
    <div class="text-center py-5">
        <h4>Nenhum livro encontrado</h4>
        <p class="text-muted">Comece adicionando seu primeiro livro!</p>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Adicionar Livro
        </a>
    </div>
@endif
@endsection