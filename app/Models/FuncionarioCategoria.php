<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioCategoria extends Model
{
    use HasFactory;

    protected $table = 'funcionario_categoria';

    protected $fillable = ["nome"];

    public function funcionario(){
        return $this->hasOne(Funcionario::class, 'funcionario_categoria');
    }
}
