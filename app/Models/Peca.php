<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    use HasFactory;

    protected $table = 'peca';

    protected $fillable = ["nome", "marca", "quantidade", "preco", "peca_categoria_id", "nome_arquivo"];

    public static function rules()
    {
        return[
            'nome' => 'required|max:80',
            'marca' => 'required|max:80',
            'quantidade' => 'required|max:20',
            'preco' => 'required|max:10',
            'peca_categoria_id' => 'required|max:30',
            'nome_arquivo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    public static function msg()
    {
        return[
            'nome.required' => 'O nome é obrigatório',
            'nome.max' => 'Só é permitido 80 caracteres',
            'marca.required' => 'A marca é obrigatória',
            'marca.max' => 'Só é permitido 80 caracteres',
            'quantidade.required' => 'O quantidadee é obrigatório',
            'quantidade.max' => 'Só é permitido 80 caracteres',
            'peca_categoria_id.required' => 'A categoria é obrigatória',
            'preco.required' => 'O preço é obrigatório',
            'preco.max' => 'Só é permitido 150 caracteres',
        ];
    }

    public function categorias()
    {
        return $this->belongsTo(PecaCategoria::class, 'peca_categoria_id', 'id');
    }
}
