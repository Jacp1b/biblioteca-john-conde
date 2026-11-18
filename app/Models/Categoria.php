<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre'];

    public function libros(): HasMany
    {
        return $this->hasMany(Libro::class);
    }

    public function puedeEliminarse(): bool
    {
        return $this->libros()->count() === 0;
    }
}
