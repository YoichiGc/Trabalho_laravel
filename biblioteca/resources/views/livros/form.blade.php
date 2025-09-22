@extends('layouts.app')

@section('content')
<h1>{{ isset($livro) ? 'Editar Livro' : 'Novo Livro' }}</h1>

<form action="{{ isset($livro) ? route('livros.update', $livro) : route('livros.store') }}" method="POST">
    @csrf
    @if(isset($livro))
        @method('PUT')
    @endif
    
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" 
               value="{{ old('titulo', $livro->titulo ?? '') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="autor_id" class="form-label">Autor</label>
        <select class="form-control" id="autor_id" name="autor_id" required>
            <option value="">Selecione um autor</option>
            @foreach($autores as $autor)
                <option value="{{ $autor->id }}" 
                    {{ (old('autor_id', $livro->autor_id ?? '') == $autor->id) ? 'selected' : '' }}>
                    {{ $autor->nome }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-3">
        <label for="ano_publicacao" class="form-label">Ano</label>
        <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" 
               value="{{ old('ano_publicacao', $livro->ano_publicacao ?? '') }}" 
               min="1000" max="{{ date('Y') }}" required>
    </div>
    
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection