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
            ->orderBy('client.nomprenom','asc')
            ->get();

        return response()->json([
            'data' => $clients,
        ]);
    } 

    public function list_client_rech($month, $year)
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
            ->whereMonth('client.dateenregistre', $month)  // Filtrer par mois
            ->whereYear('client.dateenregistre', $year)    // Filtrer par année
            ->orderBy('client.nomprenom', 'asc')
            ->get();

        return response()->json([
            'data' => $clients,
        ]);
    }

    public function list_client_se()
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
            ->orderBy('client.created_at', 'desc') // Trier par la colonne 'created_at' (ou une autre colonne)
            ->limit(15) // Limiter à 15 enregistrements
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

    public function list_proforma_all($date1, $date2)
    {
        $date1 = Carbon::parse($date1)->startOfDay();
        $date2 = Carbon::parse($date2)->endOfDay();

        $proforma = DB::table('proforma')
            ->whereBetween('proforma.date', [$date1, $date2])
            ->select('proforma.*',)
            ->orderBy('date','desc')
            ->get();

        return response()->json([
            'data' => $proforma,
        ]);
    }

    public function list_vente_all($date1, $date2)
    {
        $date1 = Carbon::parse($date1)->startOfDay();
        $date2 = Carbon::parse($date2)->endOfDay();

        $vente = DB::table('vente')
            ->join('client', 'client.matricule', '=', 'vente.matricule')
            ->whereBetween('vente.date', [$date1, $date2])
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

    public function list_facturation(Request $request)
    {

        $query = DB::table('vente')
            ->join('client', 'client.matricule', '=', 'vente.matricule')
            ->leftJoin('societe_assurance', 'societe_assurance.id', '=', 'client.societe_assurance')
            ->leftJoin('assurance', 'assurance.code', '=', 'client.assurance')
            ->join('facture_assurance', 'facture_assurance.code_vente', '=', 'vente.code')
            ->whereBetween('facture_assurance.date', [$request->date1, $request->date2])
            ->select(
                'vente.code as code_vente',
                'vente.partassurance as partassurance',
                'client.matricule_assurance as matricule_assurance',
                'client.nomprenom as client',
                'societe_assurance.libelle as societe',
                'assurance.denomination as assurance',
                'facture_assurance.numfacture as numfacture',
                'facture_assurance.date as datefacture',
            );

        if ($request->type == 'client') {
            $query->where('client.matricule', '=', $request->client);
        } elseif ($request->type == 'assurance') {
            $query->where('client.assurance', '=', $request->assurance);
        }

        $facture = $query->get();

        $total = 0;

        if ($facture->isNotEmpty()) {
            foreach ($facture as $value) {
                $montant = (int) $value->partassurance; // Assurer que c'est un nombre

                $total += $montant;
            }
        }

        return response()->json([
            'data' => $facture,
            'total' => $total,
        ]);
    }

    public function list_message_all(Request $request)
    {

        $data = DB::table('type_messages')->get();

        return response()->json([
            'data' => $data,
        ]);
    }
    
}
