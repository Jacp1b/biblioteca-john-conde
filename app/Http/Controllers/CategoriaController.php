<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('libros')->orderBy('nombre')->get();

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        Categoria::create($request->only('nombre'));

        return redirect()->route('categorias.index')->with('ok', 'Categoría creada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if (! $categoria->puedeEliminarse()) {
            return redirect()->route('categorias.index')->with('error', 'No se puede eliminar una categoría con libros asociados');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('ok', 'Categoría eliminada correctamente.');
    }
}
