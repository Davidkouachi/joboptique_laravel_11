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

class CaisseController extends Controller
{
    public function caisseOuvert($id_agence, $login)
    {
        DB::beginTransaction();

        try {

            $updateData = [
                'statut' => 1,
                'updated_at' => now(),
            ];

            $Updated = DB::table('porte_caisses')
                ->where('id', '=', 1)
                ->update($updateData);

            if ($Updated == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table porte_caisses');
            }

            $caisse = DB::table('porte_caisses')->where('id', '=', 1)->select('solde')->first();

            $Inserted = DB::table('caisse')->insert([
                'type' => null,
                'libelle' => 'OUVERTURE DE CAISSE DU '.now(),
                'montant' => $caisse->solde,
                'magasin' => $id_agence,
                'dateop' => now(),
                'datecreat' => now(),
                'heure_crea' => now(),
                'login' => $login,
                'code_client' => null,
                'type_operation' => 4,
                'num_operation' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($Inserted == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table caisse');
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function caisseFermer($id_agence, $login)
    {
        DB::beginTransaction();

        try {

            $updateData = [
                'statut' => 0,
                'updated_at' => now(),
            ];

            $Updated = DB::table('porte_caisses')
                ->where('id', '=', 1)
                ->update($updateData);

            if ($Updated == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table porte_caisses');
            }

            $caisse = DB::table('porte_caisses')->where('id', '=', 1)->select('solde')->first();

            $Inserted = DB::table('caisse')->insert([
                'type' => null,
                'libelle' => 'FERMETURE DE CAISSE DU '.now(),
                'montant' => $caisse->solde,
                'magasin' => $id_agence,
                'dateop' => now(),
                'datecreat' => now(),
                'heure_crea' => now(),
                'login' => $login,
                'code_client' => null,
                'type_operation' => 5,
                'num_operation' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($Inserted == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table caisse');
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
}
