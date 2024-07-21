<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnderecosRequest;
use App\Http\Requests\UpdateEnderecosRequest;
use App\Models\Endereco;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class EnderecosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pessoa $pessoa)
    {
        $enderecos = $pessoa->enderecos;

        return response()->json([
            'message' => 'Endereços listados com sucesso',
            'data' => [
                'pessoa' => $pessoa,
                'enderecos' => $enderecos,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnderecosRequest $request, Pessoa $pessoa)
    {
        $endereco = $pessoa->enderecos()->create($request->validated());

        return response()->json([
            'message' => 'Endereço cadastrado com sucesso',
            'data' => [
                'pessoa' => $pessoa,
                'endereco' => $endereco,
            ],
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pessoa $pessoa, Endereco $endereco)
    {
        return response()->json([
            'message' => 'Endereço listado com sucesso',
            'data' => [
                'pessoa' => $pessoa,
                'endereco' => $endereco,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnderecosRequest $request, Pessoa $pessoa, Endereco $endereco)
    {
        $endereco->update($request->validated());

        return response()->json([
            'message' => 'Endereço atualizado com sucesso',
            'data' => [
                'pessoa' => $pessoa,
                'endereco' => $endereco,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa, Endereco $endereco)
    {
        $endereco->delete();

        return response()->json([
            'message' => 'Endereço deletado com sucesso',
            'data' => [
                'pessoa' => $pessoa,
                'endereco' => $endereco,
            ],
        ]);
    }
}
