@extends('layouts.app')

@section('title', 'Libros | Biblioteca de John Conde')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Libros</h1>
            <p class="text-secondary mb-0">Consulta y administra el catálogo de la biblioteca.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('libros.create') }}">Nuevo Libro</a>
    </div>

    <form class="card card-body mb-4" method="GET" action="{{ route('libros.index') }}">
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label" for="buscar">Buscar por título</label>
                <input class="form-control" id="buscar" name="buscar" type="search" value="{{ request('buscar') }}" placeholder="Escribe un título">
            </div>
            <div class="col-md-5">
                <label class="form-label" for="categoria_id">Categoría</label>
                <select class="form-select" id="categoria_id" name="categoria_id">
                    <option value="">Todas las categorías</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected((string) request('categoria_id') === (string) $categoria->id)>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-outline-primary flex-grow-1" type="submit">Filtrar</button>
                <a class="btn btn-outline-secondary" href="{{ route('libros.index') }}">Limpiar</a>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Año</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($libros as $libro)
                        <tr>
                            <td class="fw-semibold">{{ $libro->titulo }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>{{ $libro->anio }}</td>
                            <td>{{ $libro->categoria->nombre }}</td>
                            <td>
                                <span class="badge {{ $libro->disponible ? 'text-bg-success' : 'text-bg-secondary' }}">
                                    {{ $libro->disponible ? 'Disponible' : 'No disponible' }}
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('libros.edit', $libro) }}">Editar</a>
                                <form class="d-inline" method="POST" action="{{ route('libros.destroy', $libro) }}" onsubmit="return confirm('¿Eliminar este libro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-secondary py-4" colspan="6">No hay libros que coincidan con la búsqueda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $libros->links() }}
    </div>
@endsection
