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

    public function bilan_op($year, $magasin)
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
            ->where('magasin', $magasin)
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

    public function bilan_eva_vente($year, $magasin)
    {
        $monthlyStats = [
            'client' => array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0),
            'assurance' => array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0),
            'total'  => array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0),
        ];

        // Total général
        $totalG = 0;
        $totalP = 0;
        $totalA = 0;
        $total_payer = 0;
        $total_impayer = 0;

        // Une seule requête pour tout récupérer
        $data = DB::table('vente')
            ->whereYear('date', $year)
            ->where('magasin', $magasin)
            ->select(
                DB::raw('MONTH(date) as month'),
                DB::raw('IFNULL(SUM(vente.total), 0) as total_vente'),
                DB::raw('IFNULL(SUM(vente.partclient), 0) as total_client'),
                DB::raw('IFNULL(SUM(vente.partassurance), 0) as total_assurance'),
                DB::raw('IFNULL(SUM(vente.payer), 0) as total_payer'),
                DB::raw('IFNULL(SUM(vente.reste), 0) as total_reste')
            )
            ->groupBy(DB::raw('MONTH(date)'))
            ->get();

        // Traitement des résultats
        foreach ($data as $value) {

            $monthName = date('M', mktime(0, 0, 0, intval($value->month), 10));
            // Stocker les valeurs
            $monthlyStats['client'][$monthName] = (int) $value->total_client;
            $monthlyStats['assurance'][$monthName] = (int) $value->total_assurance;
            $monthlyStats['total'][$monthName] = (int) $value->total_vente;

            // Totaux globaux
            $totalG += (int) $value->total_vente;
            $totalP += (int) $value->total_client;
            $totalA += (int) $value->total_assurance;
            $total_payer += (int) $value->total_payer;
            $total_impayer += (int) $value->total_reste;
        }

        // Retourner la réponse JSON
        return response()->json([
            'monthlyStats' => $monthlyStats,
            'total_client' => $totalP,
            'total_assurance' => $totalA,
            'total' => $totalG,
        ]);
    }

    public function stat_prevision($magasin)
    {
        $currentYear = date('Y');
        $lastYear = $currentYear - 1;
        $twoYearsAgo = $currentYear - 2; // Récupérer les données des trois dernières années

        // Récupérer les ventes mensuelles des trois dernières années (année en cours, année précédente et année d'avant)
        $salesData = DB::table('vente')
            ->select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(total) as total_vente'),
                DB::raw('COUNT(code) as nombre_ventes'),
                DB::raw('YEAR(date) as year')
            )
            ->where('magasin', $magasin)
            ->whereYear('date', '>=', $twoYearsAgo) // Condition pour récupérer les 3 dernières années
            ->groupBy(DB::raw('MONTH(date), YEAR(date)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Regrouper les données des trois années pour faire une moyenne
        $monthlyData = [];

        foreach ($salesData as $sale) {
            $month = $sale->month;

            if (!isset($monthlyData[$month])) {
                $monthlyData[$month] = [
                    'total_vente' => 0,
                    'nombre_ventes' => 0,
                    'count' => 0,
                    'years' => [] // Ajouter un tableau pour chaque année
                ];
            }

            $monthlyData[$month]['total_vente'] += $sale->total_vente;
            $monthlyData[$month]['nombre_ventes'] += $sale->nombre_ventes;
            $monthlyData[$month]['count'] += 1;
            $monthlyData[$month]['years'][$sale->year] = [
                'total_vente' => $sale->total_vente,
                'nombre_ventes' => $sale->nombre_ventes,
            ];
        }

        // Calculer la moyenne des ventes pour chaque mois
        $averageSales = [];
        foreach ($monthlyData as $month => $data) {
            $averageSales[] = (object) [
                'month' => $month,
                'total_vente' => $data['count'] > 0 ? $data['total_vente'] / $data['count'] : 0,
                'nombre_ventes' => $data['count'] > 0 ? $data['nombre_ventes'] / $data['count'] : 0,
                'years' => $data['years'], // Ajouter les données par année
            ];
        }

        // Passer $currentYear à la fonction de lissage exponentiel
        function exponentialSmoothing($data, $currentYear, $alpha = 0.2)
        {
            $smoothedData = [];
            $previousSmoothedTotal = null;
            $previousSmoothedVentes = null;

            foreach ($data as $sale) {
                // Initialisation des valeurs lissées
                if ($previousSmoothedTotal === null) {
                    $previousSmoothedTotal = $sale->total_vente;
                    $previousSmoothedVentes = $sale->nombre_ventes;
                } else {
                    // Appliquer la formule du lissage exponentiel
                    $previousSmoothedTotal = $alpha * $sale->total_vente + (1 - $alpha) * $previousSmoothedTotal;
                    $previousSmoothedVentes = $alpha * $sale->nombre_ventes + (1 - $alpha) * $previousSmoothedVentes;
                }

                // Ajouter les valeurs lissées au tableau
                $smoothedData[] = [
                    'month' => $sale->month,
                    'current_year_total' => isset($sale->years[$currentYear]) ? $sale->years[$currentYear]['total_vente'] : 0, // Montant de l'année en cours
                    'current_year_sales' => isset($sale->years[$currentYear]) ? $sale->years[$currentYear]['nombre_ventes'] : 0, // Nombre de ventes de l'année en cours
                    'smoothed_vente' => (int) round($previousSmoothedTotal), // Montant total des prévisions
                    'smoothed_nombre_ventes' => (int) round($previousSmoothedVentes), // Nombre de ventes des prévisions
                ];
            }

            return $smoothedData;
        }

        // Appliquer le lissage exponentiel aux moyennes des ventes
        $data = exponentialSmoothing($averageSales, $currentYear, 0.2);

        return response()->json([
            'prevision' => $data,
        ]);
    }

    public function bilan_client($year, $magasin)
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
            ->where('magasin', $magasin)
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

        // Retourner les résultats sous forme de réponse JSON
        return response()->json([
            'monthlyStats' => $monthlyStats,
            'total' => $total,
            'homme' => $homme,
            'femme' => $femme,
        ]);
    }

}
