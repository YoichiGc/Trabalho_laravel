@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Livros</h1>
    <a href="{{ route('livros.create') }}" class="btn btn-primary">Novo Livro</a>
</div>

<form action="{{ route('livros.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por título ou autor..." value="{{ $search }}">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </div>
</form>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ano</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($livros as $livro)
        <tr>
            <td>{{ $livro->id }}</td>
            <td>{{ $livro->titulo }}</td>
            <td>{{ $livro->autor->nome }}</td>
            <td>{{ $livro->ano_publicacao }}</td>
            <td>
                {{-- BOTÕES: APENAS EDITAR e EXCLUIR --}}
                <a href="{{ route('livros.edit', $livro) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('livros.destroy', $livro) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir este livro?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- PAGINAÇÃO --}}
<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">
        {{ $livros->onEachSide(1)->links('pagination::bootstrap-5') }}
    </ul>
</nav>

@endsection