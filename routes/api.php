<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\InsertController;

Route::middleware(['web'])->group(function () {

    Route::post('/traitement_login', [AuthController::class, 'trait_login']);

});

// Select debut
Route::get('/select_societe', [SelectController::class, 'select_societe']);
Route::get('/select_assurance', [SelectController::class, 'select_assurance']);
Route::get('/select_taux', [SelectController::class, 'select_taux']);
// Select fin

// Ajouter debut
Route::get('/insert_client', [InsertController::class, 'insert_client']);
// Ajouter fin

// Liste debut
Route::get('/list_client_all', [ListeController::class, 'list_client_all']);
// Liste fin
