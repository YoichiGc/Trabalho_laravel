@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Empréstimos</h1>
    <a href="{{ route('emprestimos.create') }}" class="btn btn-primary">Novo Empréstimo</a>
</div>

<form action="{{ route('emprestimos.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por usuário ou livro..." value="{{ $search }}">
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
            <th>Livro</th>
            <th>Usuário</th>
            <th>Data Empréstimo</th>
            <th>Data Devolução</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($emprestimos as $emprestimo)
        <tr>
            <td>{{ $emprestimo->id }}</td>
            <td>{{ $emprestimo->livro->titulo }}</td>
            <td>{{ $emprestimo->nome_usuario }}</td>
            <td>{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
            <td>{{ $emprestimo->data_devolucao ? \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') : 'Não devolvido' }}</td>
            <td>
                {{-- BOTÕES: APENAS EDITAR e EXCLUIR --}}
                <a href="{{ route('emprestimos.edit', $emprestimo) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('emprestimos.destroy', $emprestimo) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir este empréstimo?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- PAGINAÇÃO --}}
<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">
        {{ $emprestimos->onEachSide(1)->links('pagination::bootstrap-5') }}
    </ul>
</nav>

@endsection