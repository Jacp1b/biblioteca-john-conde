<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index(Request $request)
    {
        $libros = Libro::with('categoria')
            ->filtrarCategoria($request->categoria_id)
            ->buscarTitulo($request->buscar)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categorias = Categoria::orderBy('nombre')->get();

        return view('libros.index', compact('libros', 'categorias'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('libros.create', compact('categorias'));
    }

    public function show(Libro $libro)
    {
        $libro->load('categoria');

        return view('libros.show', compact('libro'));
    }

    public function store(Request $request)
    {
        $request->merge(['disponible' => $request->boolean('disponible')]);
        Libro::create($request->validate($this->reglas(), $this->mensajes()));

        return redirect()->route('libros.index')->with('ok', 'Libro creado correctamente.');
    }

    public function edit(Libro $libro)
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('libros.edit', compact('libro', 'categorias'));
    }

    public function update(Request $request, Libro $libro)
    {
        $request->merge(['disponible' => $request->boolean('disponible')]);
        $libro->update($request->validate($this->reglas(), $this->mensajes()));

        return redirect()->route('libros.index')->with('ok', 'Libro actualizado correctamente.');
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('libros.index')->with('ok', 'Libro eliminado correctamente.');
    }

    private function reglas(): array
    {
        return [
            'titulo' => ['required', 'min:3'],
            'autor' => ['required', 'min:3'],
            'anio' => ['required', 'integer', 'min:1500', 'max:'.date('Y')],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'disponible' => ['boolean'],
        ];
    }

    private function mensajes(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 3 caracteres.',
            'autor.required' => 'El autor es obligatorio.',
            'autor.min' => 'El autor debe tener al menos 3 caracteres.',
            'anio.required' => 'El año es obligatorio.',
            'anio.integer' => 'El año debe ser un número entero.',
            'anio.min' => 'El año debe ser igual o posterior a 1500.',
            'anio.max' => 'El año no puede ser posterior al año actual.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
            'disponible.boolean' => 'El estado de disponibilidad no es válido.',
        ];
    }
}
