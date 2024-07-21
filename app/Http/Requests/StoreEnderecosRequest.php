<?php

namespace App\Http\Requests;

use App\Enuns\Tipo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnderecosRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this->tipo);
        return [
            'tipo' => ['required', Rule::enum(Tipo::class)],
            'cep' => ['required', 'string', 'size:9'],
            'logradouro' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:10'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'bairro' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string'],
            'cidade' => ['required', 'string', 'max:255'],
        ];
    }
}
