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
            ->leftJoin('assurance', 'assurance.code', '=', 'societe_assurance.code_assurance')
            ->select(
                'client.*',
                'societe_assurance.libelle as societe',
                'societe_assurance.taux_couverture as taux',
                'assurance.denomination as assurance',
            )
            ->orderBy('client.dateenregistre','desc')
            ->get();

        return response()->json([
            'data' => $clients,
        ]);
    }
}
