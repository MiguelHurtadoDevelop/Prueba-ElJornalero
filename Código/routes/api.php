<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Ruta para obtener datos de usuario autenticado
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


//Rutas para obtener personajes de API externa
Route::get('/personajes/{page?}', 'App\Http\Controllers\PersonajesController@getPersonajes');

Route::get('/personaje/{id}', 'App\Http\Controllers\PersonajesController@getPersonajeById');


//Rutas para guardar personajes
Route::middleware(['auth:sanctum'])->post('/savePersonaje', 'App\Http\Controllers\SavedPersonajesController@savePersonaje');

Route::middleware(['auth:sanctum'])->get('/savedPersonajes', 'App\Http\Controllers\SavedPersonajesController@getSavedPersonajes');

Route::middleware(['auth:sanctum'])->delete('/deleteSavedPersonaje/{id}', 'App\Http\Controllers\SavedPersonajesController@deleteSavedPersonaje');


//Ruta para controlar error 404
Route::fallback(function(){
    return response()->json([
        'message' => 'Página no encontrada'
    ], 404);
});