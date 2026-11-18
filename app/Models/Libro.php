<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Libro extends Model
{
    protected $fillable = ['titulo', 'autor', 'anio', 'categoria_id', 'disponible'];

    protected function casts(): array
    {
        return [
            'anio' => 'integer',
            'disponible' => 'boolean',
        ];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function scopeFiltrarCategoria(Builder $query, $categoriaId): Builder
    {
        if ($categoriaId !== null && $categoriaId !== '') {
            $query->where('categoria_id', $categoriaId);
        }

        return $query;
    }

    public function scopeBuscarTitulo(Builder $query, $busqueda): Builder
    {
        if ($busqueda !== null && $busqueda !== '') {
            $query->where('titulo', 'like', '%'.$busqueda.'%');
        }

        return $query;
    }
}
