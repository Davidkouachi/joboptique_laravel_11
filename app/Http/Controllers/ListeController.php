<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ListeController extends Controller
{
    public function list_client_all()
    {
        $clients = DB::table('client')
            ->leftJoin('societe_assurance', 'societe_assurance.id', '=', 'client.societe_assurance')
            ->leftJoin('assurance', 'assurance.code', '=', 'client.assurance')
            ->leftJoin('tauxes', 'tauxes.id', '=', 'client.tauxes')
            ->select(
                'client.*',
                'societe_assurance.libelle as societe',
                'tauxes.valeur as taux',
                'assurance.denomination as assurance_lib',
            )
            ->orderBy('client.dateenregistre','desc')
            ->get();

        return response()->json([
            'data' => $clients,
        ]);
    }

    public function list_prospect_all()
    {
        $clients = DB::table('prospect')
            ->leftJoin('societe_assurance', 'societe_assurance.id', '=', 'prospect.societe_assurance')
            ->leftJoin('assurance', 'assurance.code', '=', 'prospect.assurance')
            ->leftJoin('tauxes', 'tauxes.id', '=', 'prospect.tauxes')
            ->select(
                'prospect.*',
                'societe_assurance.libelle as societe',
                'tauxes.valeur as taux',
                'assurance.denomination as assurance_lib',
            )
            ->orderBy('prospect.dateenregistre','desc')
            ->get();

        return response()->json([
            'data' => $clients,
        ]);
    }
    
}
