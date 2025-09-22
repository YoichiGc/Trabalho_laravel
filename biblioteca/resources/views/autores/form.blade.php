@extends('layouts.app')

@section('content')
<h1>{{ isset($autor) ? 'Editar Autor' : 'Novo Autor' }}</h1>

<form action="{{ isset($autor) ? route('autores.update', $autor) : route('autores.store') }}" method="POST">
    @csrf
    @if(isset($autor))
        @method('PUT')
    @endif
    
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" 
               value="{{ old('nome', $autor->nome ?? '') }}" required>
        @error('nome')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="nacionalidade" class="form-label">Nacionalidade</label>
        <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" 
               value="{{ old('nacionalidade', $autor->nacionalidade ?? '') }}" required>
        @error('nacionalidade')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('autores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection