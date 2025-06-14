<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\BilanController;
use App\Http\Controllers\BilanGeneraleController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\UpdateController;

Route::middleware(['web'])->group(function () {

    Route::post('/traitement_login', [AuthController::class, 'trait_login']);


    // Mise à jour debut
    Route::post('/update_type_message/{id}', [UpdateController::class, 'update_type_message']);
    // Mise à jour fin

});

// Select debut
Route::get('/select_societe', [SelectController::class, 'select_societe']);
Route::get('/select_assurance', [SelectController::class, 'select_assurance']);
Route::get('/select_taux', [SelectController::class, 'select_taux']);
Route::get('/select_client', [SelectController::class, 'select_client']);
Route::get('/select_client_prescription/{matricule}', [SelectController::class, 'select_client_prescription']);
Route::get('/select_code_proforma_vente', [SelectController::class, 'select_code_proforma_vente']);
Route::get('/select_traitement', [SelectController::class, 'select_traitement']);
Route::get('/select_type_verre', [SelectController::class, 'select_type_verre']);
Route::get('/select_op_magasin', [SelectController::class, 'select_op_magasin']);
Route::get('/select_type_message', [SelectController::class, 'select_type_message']);
// Select fin

// Recherche debut
Route::get('/caisseVerf/{magasin}', [RechercheController::class, 'caisseVerf']);
Route::get('/caisseVerfG', [RechercheController::class, 'caisseVerfG']);
Route::get('/list_rech_fac', [RechercheController::class, 'list_rech_fac']);
// Recherche fin

// Caisse debut
Route::get('/caisseOuvert/{id_agence}/{login}', [CaisseController::class, 'caisseOuvert']);
Route::get('/caisseFermer/{id_agence}/{login}', [CaisseController::class, 'caisseFermer']);
// Caisse fin

// Ajouter debut
Route::get('/insert_client', [InsertController::class, 'insert_client']);
Route::get('/insert_prospect', [InsertController::class, 'insert_prospect']);
Route::get('/insert_prescription/{matricule}', [InsertController::class, 'insert_prescription']);
Route::get('/insert_proforma', [InsertController::class, 'insert_proforma']);
Route::get('/insert_vente', [InsertController::class, 'insert_vente']);
Route::get('/insert_operation/{id_agence}/{login}', [InsertController::class, 'insert_operation']);
Route::get('/insert_versement/{code}/{matricule}', [InsertController::class, 'insert_versement']);
Route::get('/insert_type_message', [InsertController::class, 'insert_type_message']);
// Ajouter fin

// Liste debut
Route::get('/list_client_all', [ListeController::class, 'list_client_all']);
Route::get('/list_prospect_all', [ListeController::class, 'list_prospect_all']);
Route::get('/list_proforma_all/{date1}/{date2}', [ListeController::class, 'list_proforma_all']);
Route::get('/list_vente_all/{date1}/{date2}', [ListeController::class, 'list_vente_all']);
Route::get('/list_operation_all/{date1}/{date2}/{magasin}', [ListeController::class, 'list_operation_all']);
Route::get('/list_facture_client/{matricule}', [ListeController::class, 'list_facture_client']);
Route::get('/list_facturation', [ListeController::class, 'list_facturation']);
Route::get('/list_message_all', [ListeController::class, 'list_message_all']);
// Liste fin

// Supprimer debut
Route::get('/delete_type_message/{id}', [DeleteController::class, 'delete_type_message']);
Route::get('/delete_fac_proforma/{code}', [DeleteController::class, 'delete_fac_proforma']);
Route::get('/delete_fac_vente/{code}', [DeleteController::class, 'delete_fac_vente']);
// Supprimer fin

// Facture debut
Route::get('/imp_fac_proforma/{code}', [FactureController::class, 'imp_fac_proforma']);
Route::get('/imp_fac_vente/{code}/{matricule}', [FactureController::class, 'imp_fac_vente']);
Route::get('/imp_fac_recu/{code}/{matricule}/{id}', [FactureController::class, 'imp_fac_recu']);
// Facture fin

// Statistique debut
Route::get('/stat_day', [StatistiqueController::class, 'stat_day']);
Route::get('/stat_nbre/{magasin}', [StatistiqueController::class, 'stat_nbre']);
Route::get('/stat_table', [StatistiqueController::class, 'stat_table']);
// Statistique fin

// Bilan debut
Route::get('/bilan_op/{year}/{magasin}', [BilanController::class, 'bilan_op']);
Route::get('/bilan_eva_vente/{year}/{magasin}', [BilanController::class, 'bilan_eva_vente']);
Route::get('/bilan_client/{year}/{magasin}', [BilanController::class, 'bilan_client']);
Route::get('/bilan_detail_vente/{periode}/{magasin}', [BilanController::class, 'bilan_detail_vente']);
Route::get('/stat_prevision/{magasin}', [BilanController::class, 'stat_prevision']);
// Bilan fin

// Bilan Generale debut
Route::get('/G_bilan_op/{year}', [BilanGeneraleController::class, 'bilan_op']);
Route::get('/G_bilan_vente/{year}', [BilanGeneraleController::class, 'bilan_vente']);
Route::get('/G_bilan_eva_vente/{year}', [BilanGeneraleController::class, 'bilan_eva_vente']);
Route::get('/G_bilan_client/{year}', [BilanGeneraleController::class, 'bilan_client']);
Route::get('/G_bilan_detail_vente/{periode}/{magasin}', [BilanGeneraleController::class, 'bilan_detail_vente']);
Route::get('/G_stat_prevision/{magasin}', [BilanGeneraleController::class, 'stat_prevision']);
// Bilan Generale fin

// Api test
Route::get('/list_client_rech/{month}/{year}', [ListeController::class, 'list_client_rech']);
Route::get('/list_client_se', [ListeController::class, 'list_client_se']);
