@extends('layouts.app')

@section('title', 'Nueva categoría | Biblioteca de John Conde')

@section('content')
    <div class="mb-4">
        <h1 class="h2 mb-1">Nueva categoría</h1>
        <p class="text-secondary mb-0">Agrega una categoría para organizar los libros.</p>
    </div>

    <form class="card card-body" method="POST" action="{{ route('categorias.store') }}" data-custom-validation>
        @csrf
        <div class="mb-4">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required maxlength="255" data-required-message="Escribe el nombre de la categoría.">
            @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Guardar categoría</button>
            <a class="btn btn-outline-secondary" href="{{ route('categorias.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
