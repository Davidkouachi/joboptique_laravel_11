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
        $prospect = DB::table('prospect')
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
            'data' => $prospect,
        ]);
    }

    public function list_proforma_all()
    {
        $proforma = DB::table('proforma')->select('proforma.*',)->orderBy('date','desc')->get();

        return response()->json([
            'data' => $proforma,
        ]);
    }

    public function list_vente_all()
    {
        $vente = DB::table('vente')
            ->join('client', 'client.matricule', '=', 'vente.matricule')
            ->select(
                'vente.*',
                'client.nomprenom as client'
            )
            ->orderBy('vente.date','desc')
            ->get();

        return response()->json([
            'data' => $vente,
        ]);
    }

    public function list_operation_all($date1, $date2, $magasin)
    {
        $date1 = Carbon::parse($date1)->startOfDay();
        $date2 = Carbon::parse($date2)->endOfDay();
        
        $query = DB::table('caisse')
            ->leftJoin('magasin', 'magasin.id', '=', 'caisse.magasin')
            ->whereBetween('caisse.dateop', [$date1, $date2])
            ->select(
                'caisse.*',
                'magasin.nom as magasin_nom'
            )
            ->orderBy('caisse.dateop', 'desc');

        // Filtrer par magasin si nécessaire
        if ($magasin != 0) {
            $query->where('caisse.magasin', '=', $magasin);
        }

        $operation = $query->get(); // Exécuter la requête après le filtrage

        $total = 0;
        $entree = 0;
        $sortie = 0;

        if ($operation->isNotEmpty()) {
            foreach ($operation as $value) {
                $montant = (int) $value->montant; // Assurer que c'est un nombre

                if ($value->type == 'entree') {
                    $total += $montant;
                    $entree += $montant;
                } elseif ($value->type == 'sortie') {
                    $total -= $montant;
                    $sortie += $montant;
                }
            }
        }

        return response()->json([
            'data' => $operation,
            'donne' => [
                'total' => $total,
                'entree' => $entree,
                'sortie' => $sortie
            ]
        ]);
    }

    public function list_facture_client($matricule)
    {
        $facture = DB::table('vente')
            ->join('client', 'client.matricule', '=', 'vente.matricule')
            ->where('client.matricule', '=', $matricule)
            ->select(
                'vente.*',
                'client.matricule as matricule',
            )
            ->orderByRaw('vente.regle IS NOT NULL, vente.regle DESC')
            ->get();

        $total = 0;
        $payer = 0;
        $non_payer = 0;

        if ($facture->isNotEmpty()) {
            foreach ($facture as $value) {
                $total += (int) $value->partclient;
                $payer += (int) $value->payer;
                $non_payer += (int) $value->reste;

                $versement = DB::table('versement')->where('achat', '=', $value->code)->select('versement.*')->get();

                $value->versement = $versement; 

            }

        }

        return response()->json([
            'data' => $facture,
            'donne' => [
                'total' => $total,
                'payer' => $payer,
                'non_payer' => $non_payer
            ]
        ]);
    }

    
}
