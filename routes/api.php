<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\FactureController;

Route::middleware(['web'])->group(function () {

    Route::post('/traitement_login', [AuthController::class, 'trait_login']);

});

// Select debut
Route::get('/select_societe', [SelectController::class, 'select_societe']);
Route::get('/select_assurance', [SelectController::class, 'select_assurance']);
Route::get('/select_taux', [SelectController::class, 'select_taux']);
Route::get('/select_client', [SelectController::class, 'select_client']);
Route::get('/select_client_prescription/{matricule}', [SelectController::class, 'select_client_prescription']);
// Select fin

// Ajouter debut
Route::get('/insert_client', [InsertController::class, 'insert_client']);
Route::get('/insert_prospect', [InsertController::class, 'insert_prospect']);
Route::get('/insert_prescription/{matricule}', [InsertController::class, 'insert_prescription']);
Route::get('/insert_proforma', [InsertController::class, 'insert_proforma']);
// Ajouter fin

// Liste debut
Route::get('/list_client_all', [ListeController::class, 'list_client_all']);
Route::get('/list_prospect_all', [ListeController::class, 'list_prospect_all']);
Route::get('/list_proforma_all', [ListeController::class, 'list_proforma_all']);
// Liste fin

// Facture debut
Route::get('/imp_fac_proforma/{code}', [FactureController::class, 'imp_fac_proforma']);
// Facture fin
