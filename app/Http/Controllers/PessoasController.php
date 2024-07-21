<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePessoasRequest;
use App\Http\Requests\UpdatePessoasRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pessoas = Pessoa::all();

        return response()->json([
            'message' => 'Pessoas listadas com sucesso',
            'data' => $pessoas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePessoasRequest $request)
    {
        $pessoa = Pessoa::create($request->validated());

        return response()->json([
            'message' => 'Pessoa cadastrada com sucesso',
            'data' => $pessoa,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pessoa $pessoa)
    {
        return response()->json([
            'message' => 'Pessoa listada com sucesso',
            'data' => $pessoa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePessoasRequest $request, Pessoa $pessoa)
    {
        $pessoa->update($request->validated());

        return response()->json([
            'message' => 'Pessoa atualizada com sucesso',
            'data' => $pessoa,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();

        return response()->json([
            'message' => 'Pessoa deletada com sucesso',
        ]);
    }
}
