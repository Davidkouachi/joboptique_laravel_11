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

    public function imp_fac_vente($code, $matricule)
    {
        
        $facture = DB::table('vente')
            ->join('client', 'client.matricule', '=', 'vente.matricule')
            ->leftJoin('tauxes', 'tauxes.id', '=', 'client.tauxes')
            ->leftJoin('assurance', 'assurance.code', '=', 'client.assurance')
            ->leftJoin('societe_assurance', 'societe_assurance.id', '=', 'client.societe_assurance')
            ->where('vente.code', '=', $code)
            ->select(
                'vente.*',
                'client.nomprenom as client',
                'client.matricule as matricule',
                'client.datenais as datenais',
                'client.sondage as sondage',
                'client.cel as contact',
                'client.matricule_assurance as matriculeass',
                'assurance.denomination as assurance',
                'societe_assurance.libelle as societe',
                'tauxes.valeur as taux',
                DB::raw("
                    CASE 
                        WHEN vente.partassurance > 0 THEN ROUND((vente.partassurance / vente.total) * 100, 2)
                        ELSE 0
                    END as pourcentage_assurance
                "),
            )
            ->first();

        if (is_null($facture)) {
            return response()->json( [ 'error' => true, 'message' => 'table vente introuvable']);
        }

        $facture_pres = DB::table('prescriptions')
            ->where('matricule', '=', $matricule)
            ->select(
                'OD',
                'OG'
            )
            ->first();

        if (is_null($facture_pres)) {
            return response()->json( [ 'error' => true, 'message' => 'table prescriptions introuvable']);
        }

        $detail = DB::table('vente_details')
            ->where('code', '=', $code)
            ->select('vente_details.*')
            ->get();

        if ($detail->isEmpty()) {
            return response()->json( [ 'error' => true, 'message' => 'table vente_details introuvable']);
        }

        $produits = [];
        foreach ($detail as $key => $value) {
            $value->total = $value->PU * $value->qte;

            $produits[] = [
                'nom' => $value->designation,
                'prix' => $value->PU,
                'qte' => $value->qte,
                'total' => $value->total,
            ];
        }

        $client = [
            'code' => $facture->code,
            'assurance' => $facture->assurance,
            'societe' => $facture->societe,
            'matriculeass' => $facture->matriculeass,
            'client' => $facture->client,
            'matricule' => $facture->matricule,
            'sondage' => $facture->sondage,
            'datenais' => $facture->datenais,
            'contact' => $facture->contact,
            'date' => $facture->date,
            'total' => $facture->total,
            'partclient' => $facture->partclient,
            'taured' => $facture->taured,
            'partassurance' => $facture->partassurance ?? 0,
            'reste' => $facture->reste ?? 0,
            'payer' => $facture->payer ?? 0,
            'pourcentage_assurance' => $facture->pourcentage_assurance ?? 0
        ];

        $pres_OD = $this->splitPrescription($facture_pres->OD);
        $pres_OG = $this->splitPrescription($facture_pres->OG);

        // Récupérer les libellés
        $pres_OD['traitement'] = $this->getLibelle('traitement', $pres_OD['traitement']);
        $pres_OD['type_verre'] = $this->getLibelle('type_verre', $pres_OD['type_verre']);

        $pres_OG['traitement'] = $this->getLibelle('traitement', $pres_OG['traitement']);
        $pres_OG['type_verre'] = $this->getLibelle('type_verre', $pres_OG['type_verre']);

        $pres = [
            $pres_OD['sphere'], $pres_OD['cylindre'], $pres_OD['axe'], $pres_OD['addition'], $pres_OD['traitement'], $pres_OD['type_verre'],
            $pres_OG['sphere'], $pres_OG['cylindre'], $pres_OG['axe'], $pres_OG['addition'], $pres_OG['traitement'], $pres_OG['type_verre']
        ];

        return response()->json(
        [
            'success' => true, 
            'message' => 'Opération éffectuée',
            'client' => $client,
            'pres' => $pres,
            'produits' => $produits,
        ]);

    }

    public function imp_fac_recu($code, $matricule,$id)
    {
        
        $facture = DB::table('vente')
            ->join('client', 'client.matricule', '=', 'vente.matricule')
            ->where('vente.code', '=', $code)
            ->select(
                'vente.*',
                'client.nomprenom as client',
                'client.matricule as matricule',
                'client.cel as contact',
            )
            ->first();

        if (is_null($facture)) {
            return response()->json( [ 'error' => true, 'message' => 'table vente introuvable']);
        }

        $facture->partassurance = $facture->partassurance ?? 0 ;

        $facture_recu = DB::table('versement')
            ->where('id', '=', $id)
            ->select(
                'versement.*'
            )
            ->first();

        if (is_null($facture_recu)) {
            return response()->json( [ 'error' => true, 'message' => 'table versement introuvable']);
        }

        return response()->json(
        [
            'success' => true, 
            'message' => 'Opération éffectuée',
            'facture' => $facture,
            'recu' => $facture_recu,
        ]);

    }







    private function splitPrescription($data) {
        $values = explode('|', $data);

        return [
            'sphere' => $values[0] ?? null,
            'cylindre' => $values[1] ?? null,
            'axe' => $values[2] ?? null,
            'addition' => $values[3] ?? null,
            'traitement' => $values[4] ?? null,
            'type_verre' => $values[5] ?? null,
        ];
    }

    private function getLibelle($table, $id) {
        return DB::table($table)->where('id', $id)->value('libelle') ?? null;
    }
}
