@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Autores</h1>
    <a href="{{ route('autores.create') }}" class="btn btn-primary">Novo Autor</a>
</div>

<form action="{{ route('autores.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por nome ou nacionalidade..." value="{{ $search }}">
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
            <th>Nome</th>
            <th>Nacionalidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($autores as $autor)
        <tr>
            <td>{{ $autor->id }}</td>
            <td>{{ $autor->nome }}</td>
            <td>{{ $autor->nacionalidade }}</td>
            <td>
                {{-- BOTÕES: APENAS EDITAR e EXCLUIR --}}
                <a href="{{ route('autores.edit', $autor) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('autores.destroy', $autor) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir este autor?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- PAGINAÇÃO --}}
<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">
        {{ $autores->onEachSide(1)->links('pagination::bootstrap-5') }}
    </ul>
</nav>

@endsection