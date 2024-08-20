<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


Route::fallback(function(){
    return response()->json([
        'message' => 'Página no encontrada'
    ], 404);
});
require __DIR__.'/auth.php';
