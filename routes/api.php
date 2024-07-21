<?php

use App\Http\Controllers\EnderecosController;
use App\Http\Controllers\PessoasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('pessoas', PessoasController::class);
Route::apiResource('pessoas.enderecos', EnderecosController::class);
