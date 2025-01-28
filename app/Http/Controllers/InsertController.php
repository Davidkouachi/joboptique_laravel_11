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

class InsertController extends Controller
{
    private function generateUniqueMatriculeClient()
    {
        do {
            $matricule = random_int(100000, 999999);
        } while (DB::table('client')->where('matricule', '=', $matricule)->exists());

        return $matricule;
    }






    public function insert_client(Request $request)
    {

        $verifications = [
            'matricule_assurance' => $request->matricule_ass ?? null,
        ];

        $Exist = DB::table('client')->where(function ($query) use ($verifications) {
            $query->where(function ($query) use ($verifications) {
                if (!is_null($verifications['matricule_assurance'])) {
                    $query->where('matricule_assurance', $verifications['matricule_assurance']);
                }
            });
        })->first();

        if ($Exist) {
            if (!is_null($verifications['matricule_assurance']) && $Exist->matricule_assurance === $verifications['matricule_assurance']) {
                return response()->json(['matricule_ass_existe' => true]);
            }
        }

        DB::beginTransaction();

        try {

            $matricule = $this->generateUniqueMatriculeClient();

            $Inserted = DB::table('client')->insert([
                'matricule' => $matricule,
                'nom' => $request->nom,
                'prenom' => $request->prenoms,
                'nomprenom' => $request->nom.' '.$request->prenoms,
                'datenais' => $request->datenais,
                'profession' => $request->profession,
                'sexe' => $request->sexe,
                'residence' => $request->residence,
                'dateenregistre' => now(),
                'cel' => $request->tel,
                'email' => $request->email,
                'reseaux_sociaux' => null,
                'sondage' => $request->sondage,
                'matricule_assurance' => $request->matricule_ass,
                'societe_assurance' => $request->societe_id,
                'commercial' => null,
                'login' => $request->login,
                'assurance' => $request->assurance_id,
                'tauxes' => $request->taux_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($Inserted == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table client');
            }

            // Valider la transaction
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
}
