<?php

namespace App\Http\Requests;

use App\Enuns\Tipo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEnderecosRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tipo' => ['string', Rule::enum(Tipo::class)],
            'cep' => ['string', 'size:9'],
            'logradouro' => ['string', 'max:255'],
            'numero' => ['string', 'max:10'],
            'complemento' => ['string', 'max:255'],
            'bairro' => ['string', 'max:255'],
            'estado' => ['string', 'size:2'],
            'cidade' => ['string', 'max:255'],
        ];
    }
}
