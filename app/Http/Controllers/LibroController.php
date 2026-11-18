<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::with('categoria')
            ->latest()
            ->paginate(10);

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
        Libro::create($request->only(['titulo', 'autor', 'anio', 'categoria_id', 'disponible']));

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
        $libro->update($request->only(['titulo', 'autor', 'anio', 'categoria_id', 'disponible']));

        return redirect()->route('libros.index')->with('ok', 'Libro actualizado correctamente.');
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('libros.index')->with('ok', 'Libro eliminado correctamente.');
    }

}
