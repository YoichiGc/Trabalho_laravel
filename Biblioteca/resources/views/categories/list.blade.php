@extends('layouts.app')

@section('title', 'Listagem de Categorias')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>🏷️ Listagem de Categorias</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nova Categoria
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('categories.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="search_type" class="form-label">Buscar por:</label>
                <select class="form-select" name="search_type" id="search_type">
                    <option value="name" {{ request('search_type') == 'name' || !request('search_type') ? 'selected' : '' }}>Nome</option>
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

@if($categories->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover border-0">
            <thead class="table-dark">
                <tr>
                    <th class="border-0">ID</th>
                    <th class="border-0">Nome</th>
                    <th class="border-0">Descrição</th>
                    <th class="border-0">Livros</th>
                    <th class="border-0">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="border-0">{{ $category->id }}</td>
                    <td class="border-0">{{ $category->name }}</td>
                    <td class="border-0">{{ $category->description ?? 'Sem descrição' }}</td>
                    <td class="border-0">
                        <span class="badge bg-info">{{ $category->books_count }} livros</span>
                    </td>
                    <td class="border-0">
                        <div class="btn-group" role="group">
                      
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
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
        <h4>Nenhuma categoria encontrada</h4>
        <p class="text-muted">Comece adicionando sua primeira categoria!</p>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Adicionar Categoria
        </a>
    </div>
@endif
@endsection