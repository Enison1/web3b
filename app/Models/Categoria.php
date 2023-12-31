<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categoria';
    public $timestamps = false;

    public function livros(): HasMany
    {
        return $this->hasMany(Livro::class)->orderByRaw('data desc')->take(3);
    }

}
