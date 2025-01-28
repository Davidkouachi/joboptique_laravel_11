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

class SelectController extends Controller
{
    public function select_societe()
    {
        $data = DB::table('societe_assurance')->select('id','libelle')->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function select_assurance()
    {
        $data = DB::table('assurance')->select('code','denomination')->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function select_taux()
    {
        $data = DB::table('tauxes')->select('id','valeur')->get();

        return response()->json([
            'data' => $data,
        ]);
    }
}
