<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Exemplar;
use App\Models\Aluno;

class Emprestimo extends Model
{
    use HasFactory;
    protected $table = 'emprestimo';
    public $timestamps = false;
    protected $casts = [
        'data' => 'datetime:Y-m-d',
    ];
    public function exemplar(): BelongsTo
    {
       return $this->belongsTo(exemplar::class);
    }

    public function aluno(): BelongsTo
    {
       return $this->belongsTo(Aluno::class);
    }
}
