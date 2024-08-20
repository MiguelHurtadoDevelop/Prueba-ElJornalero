<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;

class PersonajesController extends Controller
{
    public function getPersonajes(Request $request, $page = null)
    {
        
        $apiUrl = 'https://rickandmortyapi.com/api/character';

        $queryParams = [];

        // Comprobamos si hay página
        if ($page !== null && $page > 1) {
            $queryParams['page'] = $page;
        }

        // Comprobamos si hay parámetros de búsqueda
        if ($request->has('name')) {
            $queryParams['name'] = $request->query('name');
        }
        if ($request->has('status')) {
            $queryParams['status'] = $request->query('status');
        }
        if ($request->has('species')) {
            $queryParams['species'] = $request->query('species');
        }
        if ($request->has('type')) {
            $queryParams['type'] = $request->query('type');
        }
        if ($request->has('gender')) {
            $queryParams['gender'] = $request->query('gender');
        }

        // Hacemos la petición a la API externa con los parámetros de búsqueda
        $response = Http::get($apiUrl, $queryParams);

        // Devolvemos los datos en formato JSON
        return $response->json();
    }

    public function getPersonajeById($id)
    {
        $apiUrl = 'https://rickandmortyapi.com/api/character/' . $id;

        // Hacemos la petición a la API externa
        $response = Http::get($apiUrl);

        // Devolvemos los datos en formato JSON
        return $response->json();
    }

}
