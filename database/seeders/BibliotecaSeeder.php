<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BibliotecaSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categorias = [
            'Programación',
            'Desarrollo web',
            'Bases de datos',
            'Sistemas operativos',
            'Inteligencia artificial',
        ];

        foreach ($categorias as $nombre) {
            Categoria::firstOrCreate(['nombre' => $nombre]);
        }

        $libros = [
            ['Clean Code', 'Robert C. Martin', 2008, 'Programación'],
            ['The Pragmatic Programmer', 'Andrew Hunt y David Thomas', 1999, 'Programación'],
            ['Python Crash Course', 'Eric Matthes', 2015, 'Programación'],
            ['Eloquent JavaScript', 'Marijn Haverbeke', 2018, 'Desarrollo web'],
            ['JavaScript: The Good Parts', 'Douglas Crockford', 2008, 'Desarrollo web'],
            ['Database System Concepts', 'Abraham Silberschatz, Henry F. Korth y S. Sudarshan', 2019, 'Bases de datos'],
            ['Learning SQL', 'Alan Beaulieu', 2020, 'Bases de datos'],
            ['The Linux Command Line', 'William Shotts', 2012, 'Sistemas operativos'],
            ['Operating System Concepts', 'Abraham Silberschatz, Peter B. Galvin y Greg Gagne', 2018, 'Sistemas operativos'],
            ['Artificial Intelligence: A Modern Approach', 'Stuart Russell y Peter Norvig', 2020, 'Inteligencia artificial'],
        ];

        foreach ($libros as [$titulo, $autor, $anio, $nombreCategoria]) {
            $categoria = Categoria::where('nombre', $nombreCategoria)->firstOrFail();

            Libro::updateOrCreate(
                ['titulo' => $titulo, 'autor' => $autor],
                [
                    'anio' => $anio,
                    'categoria_id' => $categoria->id,
                    'disponible' => true,
                ],
            );
        }
    }
}
