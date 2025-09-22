@extends('layouts.app')

@section('content')
<h1>{{ isset($emprestimo) ? 'Editar Empréstimo' : 'Novo Empréstimo' }}</h1>

<form action="{{ isset($emprestimo) ? route('emprestimos.update', $emprestimo) : route('emprestimos.store') }}" method="POST">
    @csrf
    @if(isset($emprestimo))
        @method('PUT')
    @endif
    
    <div class="mb-3">
        <label for="livro_id" class="form-label">Livro</label>
        <select class="form-control" id="livro_id" name="livro_id" required>
            <option value="">Selecione um livro</option>
            @foreach($livros as $livro)
                <option value="{{ $livro->id }}" 
                    {{ (old('livro_id', $emprestimo->livro_id ?? '') == $livro->id) ? 'selected' : '' }}>
                    {{ $livro->titulo }} ({{ $livro->autor->nome }})
                </option>
            @endforeach
        </select>
        @error('livro_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="nome_usuario" class="form-label">Nome do Usuário</label>
        <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" 
               value="{{ old('nome_usuario', $emprestimo->nome_usuario ?? '') }}" required>
        @error('nome_usuario')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="data_emprestimo" class="form-label">Data do Empréstimo</label>
        <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" 
               value="{{ old('data_emprestimo', $emprestimo->data_emprestimo ?? '') }}" required>
        @error('data_emprestimo')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="data_devolucao" class="form-label">Data de Devolução (opcional)</label>
        <input type="date" class="form-control" id="data_devolucao" name="data_devolucao" 
               value="{{ old('data_devolucao', $emprestimo->data_devolucao ?? '') }}">
        @error('data_devolucao')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection