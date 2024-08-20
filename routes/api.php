<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/personajes/{page?}', 'App\Http\Controllers\PersonajesController@getPersonajes');

Route::get('/personaje/{id}', 'App\Http\Controllers\PersonajesController@getPersonajeById');


Route::middleware(['auth:sanctum'])->post('/savePersonaje', 'App\Http\Controllers\PersonajesController@savePersonaje');
