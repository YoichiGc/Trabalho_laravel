@extends('layouts.app')

@section('title', isset($author) ? 'Editar Autor' : 'Novo Autor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ isset($author) ? '👤 Editar Autor' : '👤 Novo Autor' }}</h2>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($author) ? route('authors.update', $author) : route('authors.store') }}" method="POST">
            @csrf
            @if(isset($author))
                @method('PUT')
            @endif
            
            <div class="mb-3">
                <label for="name" class="form-label">Nome *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $author->name ?? '') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nationality" class="form-label">Nacionalidade</label>
                        <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
                               id="nationality" name="nationality" value="{{ old('nationality', $author->nationality ?? '') }}">
                        @error('nationality')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                               id="birth_date" name="birth_date" 
                               value="{{ old('birth_date', $author->birth_date ? $author->birth_date->format('Y-m-d') : '') }}">
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="biography" class="form-label">Biografia</label>
                <textarea class="form-control @error('biography') is-invalid @enderror" 
                          id="biography" name="biography" rows="4">{{ old('biography', $author->biography ?? '') }}</textarea>
                @error('biography')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($author) ? 'Atualizar' : 'Salvar' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection



