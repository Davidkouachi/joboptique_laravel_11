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

class RechercheController extends Controller
{

    public function caisseVerf($magasin)
    {
        $data = DB::table('porte_caisses')->where('magasin', $magasin)->select('statut','solde')->first();

        return response()->json( [ 'data' => $data]);
    }

    public function caisseVerfG()
    {
        $data = DB::table('porte_caisses')
            ->select(
                DB::raw('IFNULL(SUM(porte_caisses.solde), 0) as solde')
            )->first();

        return response()->json( [ 'data' => $data]);
    }

    public function list_rech_fac(Request $request)
    {
        $date1 = Carbon::parse($request->date1)->startOfDay();
        $date2 = Carbon::parse($request->date2)->endOfDay();

        $query = DB::table('vente')
            ->join('client', 'client.matricule', '=', 'vente.matricule')
            ->join('utilisa', 'utilisa.login', '=', 'vente.login')
            ->join('magasin', 'magasin.id', '=', 'utilisa.magasin')
            ->whereBetween('vente.date', [$date1, $date2])
            ->select(
                'vente.*',
                'client.nomprenom as client',
            );

            if ($request->type == 1) {
                $query->where('vente.regle', '=', 1);
            } elseif ($request->type == 2) {
                $query->where('vente.regle', '=', null);
            }

            if ($request->magasin != 0) {
                $query->where('magasin.id', '=', $request->magasin);
            }

        $facture = $query->get();

        $total = 0;
        $payer = 0;
        $non_payer = 0;
        $part_assurance = 0;
        $part_client = 0;

        if ($facture->isNotEmpty()) {
            foreach ($facture as $value) {
                $total += (int) $value->total;
                $payer += (int) $value->payer;
                $non_payer += (int) $value->reste;
                $part_assurance += (int) $value->partassurance ?? 0;
                $part_client += (int) $value->partclient ?? 0;
            }

        }

        return response()->json([
            'data' => $facture,
            'donne' => [
                'total' => $total,
                'payer' => $payer,
                'non_payer' => $non_payer,
                'part_assurance' => $part_assurance,
                'part_client' => $part_client,
            ]
        ]);
    }
}
