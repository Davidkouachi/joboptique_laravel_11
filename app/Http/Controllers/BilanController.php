<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BilanController extends Controller
{

    public function bilan_op($year)
    {

        $monthlyStats = [
            'entrer' => array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0),
            'sortie' => array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0),
            'total'  => array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0),
        ];

        // Total général
        $totalG = 0;
        $total_entrer = 0;
        $total_sortie = 0;

        // Une seule requête pour tout récupérer
        $data = DB::table('caisse')
            ->whereYear('dateop', $year)
            ->groupBy(DB::raw('MONTH(dateop)'))
            ->select(
                DB::raw('MONTH(dateop) as month'),
                DB::raw('IFNULL(SUM(CASE WHEN type = "entree" THEN montant ELSE 0 END), 0) as total_entrer'),
                DB::raw('IFNULL(SUM(CASE WHEN type = "sortie" THEN montant ELSE 0 END), 0) as total_sortie')
            )
            ->get();

        // Traitement des résultats
        foreach ($data as $value) {
            $monthName = date('M', mktime(0, 0, 0, intval($value->month), 10));

            // Stocker les valeurs
            $monthlyStats['entrer'][$monthName] = (int) $value->total_entrer;
            $monthlyStats['sortie'][$monthName] = (int) $value->total_sortie;
            $monthlyStats['total'][$monthName] = (int) $value->total_entrer - (int) $value->total_sortie;

            // Totaux globaux
            $total_entrer += (int) $value->total_entrer;
            $total_sortie += (int) $value->total_sortie;
            $totalG += (int) $monthlyStats['total'][$monthName];
        }

        // Retourner la réponse JSON
        return response()->json([
            'monthlyStats' => $monthlyStats,
            'total_entrer' => $total_entrer,
            'total_sortie' => $total_sortie,
            'total' => $totalG,
        ]);
    }

    public function bilan_vente($year)
    {
        $magasin = DB::table('magasin')
            ->leftJoin('vente', 'vente.magasin', '=', 'magasin.id') // LEFT JOIN pour inclure tous les magasins
            ->select(
                'magasin.id',
                'magasin.nom',
                DB::raw('COALESCE(SUM(vente.total), 0) as total_ventes'), // Remplacer NULL par 0
                DB::raw('COALESCE(COUNT(vente.code), 0) as nombre_ventes') // Remplacer NULL par 0
            )
            ->groupBy('magasin.id', 'magasin.nom')
            ->get();

        return response()->json($magasin);
    }

    public function bilan_client($year)
    {
        // Initialiser les statistiques mensuelles
        $monthlyStats = [
            'new' => [
                'Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'Jun' => 0,
                'Jul' => 0, 'Aug' => 0, 'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0,
            ],
        ];

        $total = 0;
        $homme = 0;
        $femme = 0;

        // Requête pour compter les patients enregistrés par mois
        $patients = DB::table('client')
            ->select(
                DB::raw('MONTH(dateenregistre) as month'),
                DB::raw('COUNT(*) as count'),
                DB::raw('COUNT(CASE WHEN sexe = "M" THEN 1 END) as M_count'),
                DB::raw('COUNT(CASE WHEN sexe = "F" THEN 1 END) as F_count')
            )
            ->whereYear('dateenregistre', $year)
            ->groupBy(DB::raw('MONTH(dateenregistre)'))
            ->get();

        // Parcourir les résultats et remplir les statistiques mensuelles
        foreach ($patients as $patient) {
            $monthIndex = intval($patient->month);
            $monthName = date('M', mktime(0, 0, 0, $monthIndex, 10));
            $monthlyStats['new'][$monthName] = $patient->count;
            $total += $patient->count;
            $homme += $patient->M_count;
            $femme += $patient->F_count;
        }

        Log::info($monthlyStats);

        // Retourner les résultats sous forme de réponse JSON
        return response()->json([
            'monthlyStats' => $monthlyStats,
            'total' => $total,
            'homme' => $homme,
            'femme' => $femme,
        ]);
    }

    public function bilan_detail_vente($periode, $magasin)
    {

        list($annee, $mois) = explode('-', $periode);

        $year = $annee;
        $month = $mois;
        // Première date du mois
        $date1 = Carbon::createFromDate($annee, $mois, 1)->format('Y-m-d');
        // Dernière date du mois
        $date2 = Carbon::createFromDate($annee, $mois, 1)->endOfMonth()->format('Y-m-d');


        $nbre_proforma = DB::table('proforma')->whereBetween(DB::raw("DATE(proforma.date)"), [$date1, $date2])->where('magasin', '=', $magasin)->count() ?? 0;
        $nbre_proforma_valide = DB::table('proforma')->whereBetween(DB::raw("DATE(proforma.date)"), [$date1, $date2])->where('magasin', '=', $magasin)->where('valide', '=', 1)->count() ?? 0;
        $nbre_proforma_nvalide = DB::table('proforma')->whereBetween(DB::raw("DATE(proforma.date)"), [$date1, $date2])->where('magasin', '=', $magasin)->whereNull('valide')->count() ?? 0;

        $nbre_vente = DB::table('vente')->whereBetween(DB::raw("DATE(vente.date)"), [$date1, $date2])->where('magasin', '=', $magasin)->count() ?? 0;
        $nbre_vente_solde = DB::table('vente')->whereBetween(DB::raw("DATE(vente.date)"), [$date1, $date2])->where('magasin', '=', $magasin)->where('regle', '=', 1)->count() ?? 0;
        $nbre_vente_nsolde = DB::table('vente')->whereBetween(DB::raw("DATE(vente.date)"), [$date1, $date2])->where('magasin', '=', $magasin)->whereNull('regle')->count() ?? 0;

        $vente_nsolde = 0;
        $vente_solde = 0;
        $vente_tsolde = 0;

        $vente_partassurance = 0;
        $vente_partclient = 0;

        $vente_spartclient = 0;
        $vente_npartclient = 0;

        $vente_nbre_vers = 0;

        $data = DB::table('vente')
            ->whereBetween(DB::raw("DATE(vente.date)"), [$date1, $date2])
            ->where('magasin', '=', $magasin)->get();

        foreach ($data as $value) {
        
            $vente_tsolde += (int) $value->total;

            if ($value->regle == 1) {
                $vente_solde += (int) $value->total;
            } else {
                $vente_nsolde += (int) $value->total;
            }

            $vente_partassurance += (int) $value->partassurance;
            $vente_partclient += (int) $value->partclient;

            $vente_spartclient += (int) $value->payer;
            $vente_npartclient += (int) $value->reste;

            $nbre = DB::table('versement')->where('achat', '=', $value->code)->count() ?? 0;
            $vente_nbre_vers += $nbre;
        }

        $vente_solde_pourcent = ($nbre_vente > 0) ? round(($nbre_vente_solde / $nbre_vente) * 100, 2) : 0;
        $vente_nsolde_pourcent = ($nbre_vente > 0) ? round(($nbre_vente_nsolde / $nbre_vente) * 100, 2) : 0;

        $nbre_ass = DB::table('vente')->whereBetween(DB::raw("DATE(vente.date)"), [$date1, $date2])->where('magasin', '=', $magasin)->where('partassurance', '!=', null)->count() ?? 0;
        $nbre_nass = DB::table('vente')->whereBetween(DB::raw("DATE(vente.date)"), [$date1, $date2])->where('magasin', '=', $magasin)->whereNull('partassurance')->count() ?? 0;
        $vente_ass_pourcent = ($nbre_vente > 0) ? round(($nbre_ass / $nbre_vente) * 100, 2) : 0;
        $vente_nass_pourcent = ($nbre_vente > 0) ? round(($nbre_nass / $nbre_vente) * 100, 2) : 0;

        return response()->json([
            'data' => [
                'nbre_proforma' => $nbre_proforma,
                'nbre_proforma_valide' => $nbre_proforma_valide,
                'nbre_proforma_nvalide' => $nbre_proforma_nvalide,
                'nbre_vente' => $nbre_vente,
                'nbre_vente_solde' => $nbre_vente_solde,
                'nbre_vente_nsolde' => $nbre_vente_nsolde,
                'total_tvente' => $vente_tsolde,
                'total_nvente' => $vente_nsolde,
                'total_svente' => $vente_solde,
                'total_partassurance' => $vente_partassurance,
                'total_partclient' => $vente_partclient,
                'total_spartclient' => $vente_spartclient,
                'total_npartclient' => $vente_npartclient,
                'vente_solde_pourcent' => $vente_solde_pourcent,
                'vente_nsolde_pourcent' => $vente_nsolde_pourcent,
                'vente_ass_pourcent' => $vente_ass_pourcent,
                'vente_nass_pourcent' => $vente_nass_pourcent,
                'vente_nbre_vers' => $vente_nbre_vers
            ]
        ]);
    }

}
