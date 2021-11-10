<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionario';

    protected $fillable = ["nome", "cnpj", "telefon", "salario", "horario", "funcionario_categoria_id"];

    public static function rules()
    {
        return[
            'nome' => 'required|max:80',
            'cnpj' => 'required|max:80',
            'telefon' => 'required|max:20',
            'salario' => 'required|max:10',
            'horario' => 'required|max:30',
            'funcionario_categoria_id' => 'required|max:30'
        ];
    }

    public static function msg()
    {
        return[
            'nome.required' => 'O nome é obrigatório',
            'nome.max' => 'Só é permitido 80 caracteres',
            'cnpj.required' => 'O NCPJ é obrigatório',
            'cnpj.max' => 'Só é permitido 80 caracteres',
            'telefon.required' => 'O telefone é obrigatório',
            'telefon.max' => 'Só é permitido 80 caracteres',
            'funcionario_categoria_id.required' => 'A categoria é obrigatória',
            'salario.required' => 'O salário é obrigatório',
            'salario.max' => 'Só é permitido 150 caracteres',
            'horario.required' => 'O horário é obrigatório',
            'horario.max' => 'Só é permitido 150 caracteres',
        ];
    }

    public function categorias()
    {
        return $this->belongsTo(FuncionarioCategoria::class, 'funcionario_categoria_id', 'id');
    }
}
