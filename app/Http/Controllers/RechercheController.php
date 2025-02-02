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

class RechercheController extends Controller
{

    public function caisseVerf()
    {
        $data = DB::table('porte_caisses')->where('id', '=', 1)->select('statut','solde')->first();

        return response()->json( [ 'data' => $data]);
    }
}
