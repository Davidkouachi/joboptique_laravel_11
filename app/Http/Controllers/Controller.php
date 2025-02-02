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

    public function operation()
    {
        return view('pages.comptablite.operation');
    }

    public function encaissement()
    {
        return view('pages.comptablite.encaissement');
    }
}
