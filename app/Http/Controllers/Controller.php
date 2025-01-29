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
}
