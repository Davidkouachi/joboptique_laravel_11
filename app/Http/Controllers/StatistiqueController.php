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
        $solde_caisse = $solde->solde;

        return response()->json([
            'data' => [
                'assurance' => $nbre_assurance,
                'client' => $nbre_client,
                'agence' => $nbre_agence,
                'solde' => $solde_caisse,
            ]
        ]);
    }

    public function stat_table()
    {

        $vente = DB::table('vente')
            ->join('client', 'client.matricule', '=', 'vente.matricule')
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


}
