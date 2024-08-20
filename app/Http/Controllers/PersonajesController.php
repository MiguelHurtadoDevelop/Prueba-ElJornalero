<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;

class PersonajesController extends Controller
{
    public function getPersonajes(Request $request, $page = null)
    {
        // Base API URL
        $apiUrl = 'https://rickandmortyapi.com/api/character';

        // Initialize query parameters
        $queryParams = [];

        // Add pagination if the page is provided
        if ($page !== null && $page > 1) {
            $queryParams['page'] = $page;
        }

        // Add filters if they are provided
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

        // Make the API request with the query parameters
        $response = Http::get($apiUrl, $queryParams);

        return $response->json();
    }

    public function getPersonajeById($id)
    {
        // Base API URL
        $apiUrl = 'https://rickandmortyapi.com/api/character/' . $id;

        // Make the API request
        $response = Http::get($apiUrl);

        return $response->json();
    }

}
