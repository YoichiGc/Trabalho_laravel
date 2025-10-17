@extends('layouts.app')

@section('title', 'Listagem de Autores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>👤 Listagem de Autores</h2>
    <a href="{{ route('authors.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Autor
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('authors.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="search_type" class="form-label">Buscar por:</label>
                <select class="form-select" name="search_type" id="search_type">
                    <option value="name" {{ request('search_type') == 'name' || !request('search_type') ? 'selected' : '' }}>Nome</option>
                    <option value="nationality" {{ request('search_type') == 'nationality' ? 'selected' : '' }}>Nacionalidade</option>
                    <option value="birth_date" {{ request('search_type') == 'birth_date' ? 'selected' : '' }}>Data de Nascimento</option>
                    <option value="biography" {{ request('search_type') == 'biography' ? 'selected' : '' }}>Biografia</option>
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

<div class="card">
    <div class="card-body">
        @if($authors->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover border-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">Nome</th>
                            <th class="border-0">Nacionalidade</th>
                            <th class="border-0">Data de Nascimento</th>
                            <th class="border-0">Livros</th>
                            <th class="border-0">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                        <tr>
                            <td class="border-0">{{ $author->id }}</td>
                            <td class="border-0">{{ $author->name }}</td>
                            <td class="border-0">{{ $author->nationality ?? 'Não informado' }}</td>
                            <td class="border-0">{{ $author->birth_date ? $author->birth_date->format('d/m/Y') : 'Não informado' }}</td>
                            <td class="border-0">
                                <span class="badge bg-info">{{ $author->books_count }} livros</span>
                            </td>
                            <td class="border-0">
                                <div class="btn-group" role="group">
                
                                    <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Tem certeza que deseja excluir este autor?')">
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
            
       
        @else
            <div class="text-center py-5">
                <h4>Nenhum autor encontrado</h4>
                <p class="text-muted">Comece adicionando seu primeiro autor!</p>
                <a href="{{ route('authors.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Adicionar Autor
                </a>
            </div>
        @endif
    </div>
</div>
@endsection