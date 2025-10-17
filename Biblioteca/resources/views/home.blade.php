@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📚 Dashboard - Sistema de Biblioteca</h2>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center border-0">
            <div class="card-body">
                <i class="fas fa-book fa-3x mb-3"></i>
                <h5 class="card-title">Livros</h5>
                <p class="card-text">Gerencie o acervo de livros</p>
                <a href="{{ route('books.index') }}" class="btn btn-primary">
                    <i class="fas fa-list"></i> Ver Livros
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-center border-0">
            <div class="card-body">
                <i class="fas fa-user fa-3x mb-3"></i>
                <h5 class="card-title">Autores</h5>
                <p class="card-text">Gerencie os autores</p>
                <a href="{{ route('authors.index') }}" class="btn btn-success">
                    <i class="fas fa-list"></i> Ver Autores
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-center border-0">
            <div class="card-body">
                <i class="fas fa-tags fa-3x mb-3"></i>
                <h5 class="card-title">Categorias</h5>
                <p class="card-text">Gerencie as categorias</p>
                <a href="{{ route('categories.index') }}" class="btn btn-info">
                    <i class="fas fa-list"></i> Ver Categorias
                </a>
            </div>
        </div>
    </div>
</div>

@endsection