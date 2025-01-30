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
    public function rech_code_proforma_vente($code)
    {
        $rech = DB::table('proforma')->where('code', '=', $code)->select('code','valide')->first();

        if ($rech) {
            return response()->json( [ 'success' => true, 'data' => $rech]);
        } else {
            return response()->json( [ 'existeP' => true]);
        }

        return response()->json( [ 'error' => true]);
    }
}
