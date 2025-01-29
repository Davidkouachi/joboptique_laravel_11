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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class FactureController extends Controller
{
    public function imp_fac_proforma($code)
    {
        $facture = DB::table('proforma')
            ->where('code', '=', $code)
            ->select(
                'proforma.*'
            )
            ->first();

        if (is_null($facture)) {
            return response()->json( [ 'error' => true, 'message' => 'table proforma introuvable']);
        }

        $facture_pres = DB::table('proforma_prescriptions')
            ->where('code_proforma', '=', $code)
            ->select(
                'proforma_prescriptions.*'
            )
            ->first();

        if (is_null($facture_pres)) {
            return response()->json( [ 'error' => true, 'message' => 'table proforma_prescriptions introuvable']);
        }

        $detail = DB::table('proforma_details')
            ->where('code', '=', $code)
            ->select('proforma_details.*')
            ->get();

        if ($detail->isEmpty()) {
            return response()->json( [ 'error' => true, 'message' => 'table proforma_details introuvable']);
        }

        $totalProduit = 0;
        $produits = [];
        foreach ($detail as $key => $value) {
            $value->total = $value->PU * $value->qte;
            $totalProduit += $value->total;

            $produits[] = [
                'nom' => $value->designation,
                'prix' => $value->PU,
                'qte' => $value->qte,
                'total' => $value->total,
            ];
        }

        if ($facture->tauxred != 0) {
            $facture->netPayer = $totalProduit - ( ($totalProduit * $facture->tauxred) / 100 );
        } else {
            $facture->netPayer = $totalProduit;
        }
        $facture->total = $totalProduit;


        $client = [$facture->code,$facture->nomclient,$facture->contact,$facture->date,$facture->total,$facture->netPayer,$facture->tauxred];


        $pres = [$facture_pres->sphere_OD,$facture_pres->cylindre_OD,$facture_pres->axe_OD,$facture_pres->addition_OD,$facture_pres->sphere_OG,$facture_pres->cylindre_OG,$facture_pres->axe_OG,$facture_pres->addition_OG];

        return response()->json(
        [
            'success' => true, 
            'message' => 'Opération éffectuée',
            'client' => $client,
            'pres' => $pres,
            'produits' => $produits,
        ]);
    }
}
