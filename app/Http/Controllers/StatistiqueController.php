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

class StatistiqueController extends Controller
{

    public function stat_day()
    {
        $today = now();
        $lastWeek = now()->subWeek(); // Get the date 1 week ago

        // Get today's count for each category
        $nbre_day_proforma = DB::table('proforma')->whereDate('date', $today)->count();
        $nbre_day_vente = DB::table('vente')->whereDate('date', $today)->count();
        $nbre_day_client = DB::table('client')->whereDate('dateenregistre', $today)->count();
        $nbre_day_versement = DB::table('versement')->whereDate('date', $today)->count();

        // Get last week's count for each category
        $nbre_lastweek_proforma = DB::table('proforma')->whereDate('date', $lastWeek)->count();
        $nbre_lastweek_vente = DB::table('vente')->whereDate('date', $lastWeek)->count();
        $nbre_lastweek_client = DB::table('client')->whereDate('dateenregistre', $lastWeek)->count();
        $nbre_lastweek_versement = DB::table('versement')->whereDate('date', $lastWeek)->count();

        // Function to calculate percentage change
        $calculateChangePercentage = function($todayCount, $lastWeekCount) {
            if ($lastWeekCount == 0) {
                return $todayCount > 0 ? 100 : 0; // Prevent division by zero, assume 100% if last week was 0
            }
            return (($todayCount - $lastWeekCount) / $lastWeekCount) * 100;
        };

        // Calculate percentage change for each category
        $change_proforma = $calculateChangePercentage($nbre_day_proforma, $nbre_lastweek_proforma);
        $change_vente = $calculateChangePercentage($nbre_day_vente, $nbre_lastweek_vente);
        $change_client = $calculateChangePercentage($nbre_day_client, $nbre_lastweek_client);
        $change_versement = $calculateChangePercentage($nbre_day_versement, $nbre_lastweek_versement);

        // Prepare the response data with comparison and percentage change
        return response()->json([
            'data' => [
                'proforma' => [
                    'today' => $nbre_day_proforma,
                    'last_week' => $nbre_lastweek_proforma,
                    'change' => $change_proforma,
                ],
                'vente' => [
                    'today' => $nbre_day_vente,
                    'last_week' => $nbre_lastweek_vente,
                    'change' => $change_vente,
                ],
                'client' => [
                    'today' => $nbre_day_client,
                    'last_week' => $nbre_lastweek_client,
                    'change' => $change_client,
                ],
                'versement' => [
                    'today' => $nbre_day_versement,
                    'last_week' => $nbre_lastweek_versement,
                    'change' => $change_versement,
                ],
            ]
        ]);
    }

    public function stat_nbre($magasin)
    {

        $nbre_assurance = DB::table('assurance')->count();
        $nbre_client = DB::table('client')->count();
        $nbre_agence = DB::table('magasin')->count();
        $solde = DB::table('porte_caisses')->where('magasin', $magasin)->select('solde')->first();
        // $solde = DB::table('porte_caisses')->sum('solde');
        $solde_caisse = $solde;
        $serviceCount = DB::table('service')->count();
        $userCount = DB::table('users')->count();

        return response()->json([
            'data' => [
                'assurance' => $nbre_assurance,
                'client' => $nbre_client,
                'agence' => $nbre_agence,
                'solde' => $solde_caisse,
                'service' => $serviceCount,
                'users' => $userCount,
            ]
        ]);
    }

    public function stat_table($magasin)
    {

        $vente = DB::table('vente')
            ->join('client', 'client.matricule', '=', 'vente.matricule')
            ->where('vente.magasin', $magasin)
            ->select(
                'vente.*',
                'client.nomprenom as client'
            )
            ->orderBy('vente.date','desc')
            ->limit(10)
            ->get();

        return response()->json([
            'data' => $vente
        ]);
    }

    public function stat_vente_proforma($magasin)
    {
        $currentYear = date('Y');

        // 1. Récupérer les ventes de l'année en cours
        $salesData = DB::table('vente')
            ->select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(total) as total_vente'),
                DB::raw('COUNT(code) as nombre_vente')
            )
            ->where('magasin', $magasin)
            ->whereYear('date', $currentYear)
            ->groupBy(DB::raw('MONTH(date)'))
            ->get()
            ->keyBy('month');

        // 2. Récupérer les proformas de l'année en cours
        $proformaData = DB::table('proforma')
            ->select(
                DB::raw('MONTH(date) as month'),
                DB::raw('COUNT(code) as nombre_proforma')
            )
            ->where('magasin', $magasin)
            ->whereYear('date', $currentYear)
            ->groupBy(DB::raw('MONTH(date)'))
            ->get()
            ->keyBy('month');

        // 3. Initialiser les 12 mois avec données
        $dataByMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $vente = $salesData->get($i);
            $proforma = $proformaData->get($i);

            $dataByMonth[] = (object) [
                'month' => $i,
                'month_name' => \Carbon\Carbon::createFromDate(null, $i, 1)->translatedFormat('F'),
                'total_vente' => $vente ? (float) $vente->total_vente : 0,
                'nombre_vente' => $vente ? (int) $vente->nombre_vente : 0,
                'nombre_proforma' => $proforma ? (int) $proforma->nombre_proforma : 0,
            ];
        }

        return response()->json([
            'annee' => $currentYear,
            'prevision' => $dataByMonth,
        ]);
    }

    public function stat_rapport_caisse($magasin)
    {
        $currentYear = date('Y');

        // Total général
        $totalG = 0;
        $total_entrer = 0;
        $total_sortie = 0;

        // Une seule requête pour tout récupérer
        $data = DB::table('caisse')
            ->whereYear('dateop', $currentYear)
            ->groupBy(DB::raw('MONTH(dateop)'))
            ->select(
                DB::raw('MONTH(dateop) as month'),
                DB::raw('IFNULL(SUM(CASE WHEN type = "entree" THEN montant ELSE 0 END), 0) as total_entrer'),
                DB::raw('IFNULL(SUM(CASE WHEN type = "sortie" THEN montant ELSE 0 END), 0) as total_sortie')
            )
            ->get();

        // Traitement des résultats
        foreach ($data as $value) {

            // Totaux globaux
            $total_entrer += (int) $value->total_entrer;
            $total_sortie += (int) $value->total_sortie;
        }

        // Retourner la réponse JSON
        return response()->json([
            'annee' => $currentYear,
            'total_entrer' => $total_entrer,
            'total_sortie' => $total_sortie,
            'total' => (int) $total_entrer - $total_sortie,
        ]);
    }

}
