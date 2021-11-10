<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurmaCategoria extends Model
{
    use HasFactory;
    protected $table = 'turma_categoria';

    protected $fillable = ["nome", "sigla"];
}
