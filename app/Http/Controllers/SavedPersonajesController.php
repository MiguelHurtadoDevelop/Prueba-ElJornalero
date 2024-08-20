<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\SavedPersonaje;
use Illuminate\Support\Facades\Http;

class SavedPersonajesController extends Controller
{
    public function savePersonaje(Request $request)
    {
        //Validación del id del personaje
        $request->validate([
            'personaje_id' => 'required|integer',
        ]);

        
        $user = $request->user();

        // Comprobamos si el personaje existe
        $apiUrl = 'https://rickandmortyapi.com/api/character/' . $request->personaje_id;

        $response = Http::get($apiUrl);

        if ($response->status() !== 200) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        // Comprobamos si el personaje ya ha sido guardado
        $savedPersonaje = SavedPersonaje::where('personaje_id', $request->personaje_id)
            ->where('user_id', $user->id)
            ->first();

        if ($savedPersonaje) {
            return response()->json(['message' => 'Character already saved'], 400);
        }


        // Guardamos el personaje

        SavedPersonaje::create([
            'personaje_id' => $request->personaje_id,
            'user_id' => $user->id,
        ]);

        
        // Devolvemos una respuesta de éxito
        return response()->json(['message' => 'Character saved successfully'], 201);
    }

    public function getSavedPersonajes(Request $request)
    {
        // Obtenemos el usuario autenticado
        $user = $request->user();

        // Obtenemos los personajes guardados por el usuario
        $savedPersonajes = SavedPersonaje::where('user_id', $user->id)->get();

        // Obtenemos los personajes de la API externa
        $savedIds = $savedPersonajes->pluck('personaje_id');

        $apiUrl = 'https://rickandmortyapi.com/api/character/' . $savedIds->join(',');

        $response = Http::get($apiUrl);

        $savedPersonajes = $response->json();

        // Devolvemos los personajes guardados
        return response()->json($savedPersonajes);
    }

    public function deleteSavedPersonaje(Request $request, $id)
    {
        // Obtenemos el usuario autenticado
        $user = $request->user();

        // Comprobamos si el personaje ha sido guardado
        $savedPersonaje = SavedPersonaje::where('personaje_id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$savedPersonaje) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        // Eliminamos el personaje guardado
        $savedPersonaje->delete();

        // Devolvemos una respuesta de éxito
        return response()->json(['message' => 'Character deleted successfully']);
    }
}
