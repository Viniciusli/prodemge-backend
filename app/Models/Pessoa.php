<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nome_social',
        'cpf',
        'nome_pai',
        'nome_mae',
        'telefone',
        'email',
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
