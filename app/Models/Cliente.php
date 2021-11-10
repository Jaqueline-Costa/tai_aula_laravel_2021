<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $fillable = ["nome", "telefone", "email", "data_inicio", "data_final"];

    public static function rules()
    {
        return[
            'nome' => 'required|max:50',
            'telefone' => 'required|max:20',
            'email' => 'required|max:50',
            'data_inicio' => 'required|max:100',
            'data_final' => 'required|max:100'
        ];
    }

    public static function msg()
    {
        return[
            'nome.required' => 'O nome é obrigatório',
            'nome.max' => 'Só é permitido 80 caracteres',
            'telefone.required' => 'O telefone é obrigatório',
            'telefone.max' => 'Só é permitido 20 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.max' => 'Só é permitido 50 caracteres',
            'data_inicio.required' => 'A data início é obrigatória',
            'data_inicio.max' => 'Só é permitido 100 caracteres',
            'data_final.required' => 'A data final é obrigatória',
            'data_final.max' => 'Só é permitido 100 caracteres',
        ];
    }
}
