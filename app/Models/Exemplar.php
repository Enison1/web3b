<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exemplar extends Model
{
    use HasFactory;
    protected $table = 'exemplar';
    public $timestamps = false;

    public function exemplares(): HasMany
    {
        return $this->hasMany(Exemplar::class)->orderByRaw('data desc')->take(3);
    }

}
