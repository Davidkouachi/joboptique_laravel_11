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

	Route::get('/Facture Proforma', [Controller::class, 'proforma'])->name('proforma');

});

