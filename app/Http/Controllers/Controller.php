<?php

namespace App\Http\Controllers;

class Controller
{
    public function tableau_bord()
    {
        return view('pages.tableau_bord');
    }

    public function client()
    {
        return view('pages.client&prospect.client');
    }

    public function prospect()
    {
        return view('pages.client&prospect.prospect');
    }

    public function prescription()
    {
        return view('pages.prescription');
    }

    public function proforma()
    {
        return view('pages.facture.proforma');
    }

    public function vente()
    {
        return view('pages.facture.vente');
    }

    public function his_facture()
    {
        return view('pages.facture.his_facture');
    }

    public function operation()
    {
        return view('pages.comptablite.operation');
    }

    public function encaissement()
    {
        return view('pages.comptablite.encaissement');
    }

    public function bilan_comptable()
    {
        return view('pages.comptablite.bilan_comptable');
    }

    public function bilan_generale_comptable()
    {
        return view('pages.comptablite.bilan_generale_comptable');
    }

    public function facturation_assurance()
    {
        return view('pages.facturation.assurance');
    }

    public function recherche_facture()
    {
        return view('pages.recherche_facture');
    }

    public function notification()
    {
        return view('pages.notification');
    }
}
