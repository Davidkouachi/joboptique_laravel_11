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
    private function splitPrescription($prescription)
    {
        $parts = explode('|', $prescription);
        return [
            'sphere' => $parts[0] ?? null,
            'cylindre' => $parts[1] ?? null,
            'axe' => $parts[2] ?? null,
            'addition' => $parts[3] ?? null,
            'traitement' => $parts[4] ?? null,
            'type_verre' => $parts[5] ?? null,
        ];
    }




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

    public function select_client()
    {
        $data = DB::table('client')->select('matricule','nomprenom','cel','tauxes')->orderBy('nomprenom', 'asc')->get();

        foreach ($data as $value) {
            $taux = 0;

            if (!is_null($value->tauxes)) {
                $valeur = DB::table('tauxes')
                    ->where('id', '=', $value->tauxes)
                    ->select('valeur')
                    ->first();

                if ($valeur) {
                    $taux = $valeur->valeur;
                }
            }

            $value->taux = $taux;
        }

        return response()->json([
            'data' => $data,
        ]);
    }


    public function select_client_prescription($matricule)
    {
        $data = DB::table('prescriptions')
            ->where('matricule', '=', $matricule)
            ->select('OD', 'OG')
            ->get();

        // Traiter chaque prescription et séparer les données
        $formattedData = $data->map(function ($item) {
            return [
                'OD' => $this->splitPrescription($item->OD),
                'OG' => $this->splitPrescription($item->OG),
            ];
        });

        return response()->json([
            'data' => $formattedData,
        ]);
    }

    public function select_code_proforma_vente()
    {
        $data = DB::table('proforma')->where('valide', '=', null)->select('code')->get();

        return response()->json( [ 'data' => $data]);
    }

    public function select_traitement()
    {
        $data = DB::table('traitement')->select('id','libelle')->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function select_type_verre()
    {
        $data = DB::table('type_verre')->select('id','libelle')->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function select_op_magasin()
    {
        $data = DB::table('magasin')->select('id','nom')->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function select_type_message()
    {
        $data = DB::table('type_messages')->select('id','type','message')->get();

        return response()->json([
            'data' => $data,
        ]);
    }
}
