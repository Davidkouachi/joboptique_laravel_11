<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListeController;

Route::middleware(['web'])->group(function () {

    Route::post('/traitement_login', [AuthController::class, 'trait_login']);

});

// Liste debut
Route::get('/list_client_all', [ListeController::class, 'list_client_all']);
// Liste fin
