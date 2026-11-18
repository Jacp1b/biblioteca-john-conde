<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BibliotecaTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_redirects_to_the_book_list(): void
    {
        $this->get('/')
            ->assertRedirect('/libros');
    }

    public function test_book_list_can_be_filtered_by_category_and_title(): void
    {
        $programacion = Categoria::create(['nombre' => 'Programación']);
        $web = Categoria::create(['nombre' => 'Desarrollo web']);
        Libro::create([
            'titulo' => 'JavaScript moderno',
            'autor' => 'Ada Lovelace',
            'anio' => 2020,
            'categoria_id' => $web->id,
            'disponible' => true,
        ]);
        Libro::create([
            'titulo' => 'PHP moderno',
            'autor' => 'Grace Hopper',
            'anio' => 2021,
            'categoria_id' => $programacion->id,
            'disponible' => true,
        ]);

        $this->get(route('libros.index', [
            'categoria_id' => $web->id,
            'buscar' => 'JavaScript',
        ]))
            ->assertOk()
            ->assertSee('JavaScript moderno')
            ->assertDontSee('PHP moderno');
    }

    public function test_book_can_be_created_updated_and_deleted(): void
    {
        $categoria = Categoria::create(['nombre' => 'Programación']);
        $datos = [
            'titulo' => 'Libro de prueba',
            'autor' => 'Autora de prueba',
            'anio' => 2020,
            'categoria_id' => $categoria->id,
            'disponible' => '1',
        ];

        $this->post(route('libros.store'), $datos)
            ->assertRedirect(route('libros.index'))
            ->assertSessionHas('ok', 'Libro creado correctamente.');

        $libro = Libro::where('titulo', 'Libro de prueba')->firstOrFail();
        $this->put(route('libros.update', $libro), [...$datos, 'titulo' => 'Libro actualizado'])
            ->assertRedirect(route('libros.index'));
        $this->assertDatabaseHas('libros', [
            'id' => $libro->id,
            'titulo' => 'Libro actualizado',
        ]);

        $this->delete(route('libros.destroy', $libro))
            ->assertRedirect(route('libros.index'));
        $this->assertDatabaseMissing('libros', ['id' => $libro->id]);
    }

    public function test_invalid_book_data_is_rejected_with_spanish_messages(): void
    {
        $response = $this->from(route('libros.create'))
            ->post(route('libros.store'), [
                'titulo' => 'AB',
                'autor' => 'XY',
                'anio' => 1499,
                'categoria_id' => 999,
            ]);

        $response->assertRedirect(route('libros.create'))
            ->assertSessionHasErrors([
                'titulo' => 'El título debe tener al menos 3 caracteres.',
                'autor' => 'El autor debe tener al menos 3 caracteres.',
                'anio' => 'El año debe ser igual o posterior a 1500.',
                'categoria_id' => 'La categoría seleccionada no existe.',
            ]);
        $this->assertDatabaseCount('libros', 0);
    }

    public function test_category_names_must_be_unique(): void
    {
        Categoria::create(['nombre' => 'Bases de datos']);

        $response = $this->from(route('categorias.create'))
            ->post(route('categorias.store'), ['nombre' => 'Bases de datos']);

        $response->assertRedirect(route('categorias.create'))
            ->assertSessionHasErrors('nombre');
        $this->assertDatabaseCount('categorias', 1);
    }

    public function test_categories_with_books_cannot_be_deleted(): void
    {
        $categoria = Categoria::create(['nombre' => 'Bases de datos']);
        Libro::create([
            'titulo' => 'SQL práctico',
            'autor' => 'Autora de prueba',
            'anio' => 2020,
            'categoria_id' => $categoria->id,
            'disponible' => true,
        ]);

        $this->delete(route('categorias.destroy', $categoria))
            ->assertRedirect(route('categorias.index'))
            ->assertSessionHas('error', 'No se puede eliminar una categoría con libros asociados');

        $this->assertDatabaseHas('categorias', ['id' => $categoria->id]);
    }
}
