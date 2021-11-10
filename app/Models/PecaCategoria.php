<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PecaCategoria extends Model
{
    use HasFactory;

    protected $table = 'peca_categoria';

    protected $fillable = ["nome"];

    public function peca(){
        return $this->hasOne(Peca::class, 'peca_categoria');
    }
}


