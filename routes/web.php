<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;

Route::get('/refresh-csrf', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::get('/Se Connecter', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
	Route::get('/deconnecter', [AuthController::class, 'deconnecter'])->name('deconnecter');

	Route::get('/', [Controller::class, 'tableau_bord'])->name('tableau_bord');

	Route::get('/Clients', [Controller::class, 'client'])->name('client');
	Route::get('/Prospects', [Controller::class, 'prospect'])->name('prospect');

	Route::get('/Préscriptions', [Controller::class, 'prescription'])->name('prescription');

	Route::get('/Facture Proforma', [Controller::class, 'proforma'])->name('proforma');
	Route::get('/Nouvelle Vente', [Controller::class, 'vente'])->name('vente');

	Route::get('/Opération de Caisse', [Controller::class, 'operation'])->name('operation');
	Route::get('/Encaissements', [Controller::class, 'encaissement'])->name('encaissement');
	Route::get('/Blian Général', [Controller::class, 'bilan_generale_comptable'])->name('bilan_generale_comptable');
	Route::get('/Rapport Magasin', [Controller::class, 'bilan_comptable'])->name('bilan_comptable');
	Route::get('/Historique facture', [Controller::class, 'his_facture'])->name('his_facture');

	Route::get('/Facturation Assurances', [Controller::class, 'facturation_assurance'])->name('facturation_assurance');

	Route::get('/Recherche Facture', [Controller::class, 'recherche_facture'])->name('recherche_facture');

	Route::get('/Notifications', [Controller::class, 'notification'])->name('notification');

});

