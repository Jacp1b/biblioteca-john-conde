@extends('layouts.app')

@section('title', 'Nuevo libro | Biblioteca de John Conde')

@section('content')
    <div class="mb-4">
        <h1 class="h2 mb-1">Nuevo libro</h1>
        <p class="text-secondary mb-0">Completa los datos para agregar un libro al catálogo.</p>
    </div>

    <form class="card card-body" method="POST" action="{{ route('libros.store') }}" data-custom-validation>
        @csrf
        <div class="mb-3">
            <label class="form-label" for="titulo">Título</label>
            <input class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required minlength="3" data-required-message="Escribe el título del libro." data-minlength-message="El título debe tener al menos 3 caracteres.">
            @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="autor">Autor</label>
            <input class="form-control @error('autor') is-invalid @enderror" id="autor" name="autor" value="{{ old('autor') }}" required minlength="3" data-required-message="Escribe el nombre del autor." data-minlength-message="El autor debe tener al menos 3 caracteres.">
            @error('autor') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="anio">Año</label>
            <input class="form-control @error('anio') is-invalid @enderror" id="anio" name="anio" type="number" min="1500" max="{{ date('Y') }}" value="{{ old('anio') }}" required data-required-message="Indica el año de publicación." data-min-message="El año debe ser 1500 o posterior." data-max-message="El año no puede superar el año actual.">
            @error('anio') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="categoria_id">Categoría</label>
            <select class="form-select @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id" required data-required-message="Selecciona una categoría para el libro.">
                <option value="">Selecciona una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected((string) old('categoria_id') === (string) $categoria->id)>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input @error('disponible') is-invalid @enderror" id="disponible" name="disponible" type="checkbox" value="1" @checked(old('disponible', true))>
            <label class="form-check-label" for="disponible">Disponible para préstamo</label>
            @error('disponible') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit">Guardar libro</button>
            <a class="btn btn-outline-secondary" href="{{ route('libros.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
