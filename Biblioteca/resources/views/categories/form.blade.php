@extends('layouts.app')

@section('title', isset($category) ? 'Editar Categoria' : 'Nova Categoria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ isset($category) ? '🏷️ Editar Categoria' : '🏷️ Nova Categoria' }}</h2>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif
            
            <div class="mb-3">
                <label for="name" class="form-label">Nome *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4">{{ old('description', $category->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($category) ? 'Atualizar' : 'Salvar' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection



