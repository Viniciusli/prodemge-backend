<?php

namespace App\Models;

use App\Enuns\Tipo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'pessoa_id',
        'tipo',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'estado',
        'cidade',
    ];

    protected $casts = [
        'tipo' => Tipo::class
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
