@extends('layouts.app')

@section('title', $libro->titulo.' | Biblioteca de John Conde')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">{{ $libro->titulo }}</h1>
            <p class="text-secondary mb-0">Detalles del libro.</p>
        </div>
        <a class="btn btn-outline-secondary" href="{{ route('libros.index') }}">Volver al catálogo</a>
    </div>

    <dl class="card card-body row mb-0">
        <dt class="col-sm-3">Autor</dt>
        <dd class="col-sm-9">{{ $libro->autor }}</dd>
        <dt class="col-sm-3">Año</dt>
        <dd class="col-sm-9">{{ $libro->anio }}</dd>
        <dt class="col-sm-3">Categoría</dt>
        <dd class="col-sm-9">{{ $libro->categoria->nombre }}</dd>
        <dt class="col-sm-3">Estado</dt>
        <dd class="col-sm-9">{{ $libro->disponible ? 'Disponible' : 'No disponible' }}</dd>
    </dl>
@endsection
