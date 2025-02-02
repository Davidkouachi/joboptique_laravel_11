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
            $matricule = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8));
        } while (DB::table('client')->where('matricule', '=', $matricule)->exists());

        return $matricule;
    }

    private function generateUniqueMatriculeProspect()
    {
        do {
            $matricule = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10));
        } while (DB::table('prospect')->where('code', '=', $matricule)->exists());

        return $matricule;
    }

    private function generateUniqueMatriculeProforma()
    {
        do {
            $matricule = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8));
        } while (DB::table('proforma')->where('code', '=', $matricule)->exists());

        return $matricule;
    }

    private function generateUniqueMatriculeVente()
    {
        do {
            $matricule = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8));
        } while (DB::table('vente')->where('code', '=', $matricule)->exists());

        return $matricule;
    }

    private function generateUniqueNumeroOperation()
    {
        do {
            $matricule = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8));
        } while (DB::table('caisse')->where('num_operation', '=', $matricule)->exists());

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

    public function insert_prospect(Request $request)
    {

        $verifications = [
            'matricule_assurance' => $request->matricule_ass ?? null,
        ];

        $Exist = DB::table('prospect')->where(function ($query) use ($verifications) {
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

            $matricule = $this->generateUniqueMatriculeProspect();

            $Inserted = DB::table('prospect')->insert([
                'code' => $matricule,
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
                'obs' => $request->obs,
                'motif_visite' => $request->motif,
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
                throw new Exception('Erreur lors de l\'insertion dans la table prospect');
            }

            // Valider la transaction
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function insert_prescription(Request $request, $matricule)
    {

        DB::beginTransaction();

        try {

            $OD = $request->sphere_OD.'|'.$request->cylindre_OD.'|'.$request->axe_OD.'|'.$request->addition_OD.'|'.$request->traitement_OD.'|'.$request->type_verre_OD;

            $OG = $request->sphere_OG.'|'.$request->cylindre_OG.'|'.$request->axe_OG.'|'.$request->addition_OG.'|'.$request->traitement_OG.'|'.$request->type_verre_OG;

            $rech = DB::table('prescriptions')->where('matricule', '=', $matricule)->exists();

            if ($rech) {
                
                $updateData = [
                    'OD' => $OD,
                    'OG' => $OG,
                    'date' => now(),
                    'login' => $request->login,
                    'updated_at' => now(),
                ];

                $Updated = DB::table('prescriptions')
                    ->where('matricule', '=', $matricule)
                    ->update($updateData);

                if ($Updated == 0) {
                    throw new Exception('Erreur lors de la mise à jour dans la table prescriptions');
                }

            } else {

                $Inserted = DB::table('prescriptions')->insert([
                    'matricule' => $matricule,
                    'OD' => $OD,
                    'OG' => $OG,
                    'date' => now(),
                    'login' => $request->login,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if ($Inserted == 0) {
                    throw new Exception('Erreur lors de l\'insertion dans la table prescriptions');
                }

            }

            // Valider la transaction
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function insert_proforma(Request $request)
    {
        $selections = $request->input('selectionsProduit');
        if (!is_array($selections) || empty($selections)) {
            return response()->json(['json' => true]);
        }

        $code = $this->generateUniqueMatriculeProforma();

        DB::beginTransaction();

        try {

            $Inserted0 = DB::table('proforma')->insert([
                'code' => $code,
                'date' => $request->date,
                'tauxred' => $request->remise,
                'nomclient' => $request->nom,
                'contact' => $request->tel,
                'email' => null,
                'login' => $request->login,
                'valide' => null,
                'relance_client' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($Inserted0 == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table proforma');
            }

            foreach ($selections as $value) {

                $detailInsert = DB::table('proforma_details')->insert([
                    'code' => $code,
                    'designation' => $value['nom'],
                    'PU' =>  str_replace('.', '', $value['prix']),
                    'qte' => $value['qte'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if ($detailInsert == 0) {
                    throw new Exception('Erreur lors de l\'insertion dans la table proforma_details');
                }

            }

            $Inserted1 = DB::table('proforma_prescriptions')->insert([
                'code_proforma' => $code,
                'sphere_OD' => $request->sphere_OD,
                'cylindre_OD' => $request->cylindre_OD,
                'axe_OD' => $request->axe_OD,
                'addition_OD' => $request->addition_OD,
                'sphere_OG' => $request->sphere_OG,
                'cylindre_OG' => $request->cylindre_OG,
                'axe_OG' => $request->axe_OG,
                'addition_OG' => $request->addition_OG,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($Inserted1 == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table proforma_prescriptions');
            }

            $client = [$code,$request->nom,$request->tel,$request->date,$request->total,$request->netPayer,$request->remise];
            $pres = [$request->sphere_OD,$request->cylindre_OD,$request->axe_OD,$request->addition_OD,$request->sphere_OG,$request->cylindre_OG,$request->axe_OG,$request->addition_OG];
            $produits = $selections;

            // Valider la transaction
            DB::commit();
            return response()->json(
                [
                    'success' => true, 
                    'message' => 'Opération éffectuée',
                    'client' => $client,
                    'pres' => $pres,
                    'produits' => $produits,
                ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function insert_vente(Request $request)
    {
        $selections = $request->input('selectionsProduit');
        if (!is_array($selections) || empty($selections)) {
            return response()->json(['json' => true]);
        }

        $code = $this->generateUniqueMatriculeVente();

        DB::beginTransaction();

        try {

            $Inserted0 = DB::table('vente')->insert([
                'code' => $code,
                'matricule' => $request->client,
                'total' => $request->total,
                'partassurance' => $request->netAssurance,
                'partclient' => $request->netPayer,
                'reste' => $request->netPayer,
                'payer' => 0,
                'taured' => $request->remise,
                'date' => now(),
                'login' => $request->login,
                'regle' => null,
                'date_retrait' => null,
                'observation' => null,
                'livre' => null,
                'date_livraison' => null,
                'heure_livraison' => null,
                'login_livraison' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($Inserted0 == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table vente');
            }

            foreach ($selections as $value) {

                $detailInsert = DB::table('vente_details')->insert([
                    'code' => $code,
                    'designation' => $value['nom'],
                    'PU' =>  str_replace('.', '', $value['prix']),
                    'qte' => $value['qte'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if ($detailInsert == 0) {
                    throw new Exception('Erreur lors de l\'insertion dans la table vente_details');
                }

            }

            if ($request->code_proforma != 0) {
                
                DB::table('proforma')
                    ->where('code', '=', $request->code_proforma)
                    ->update([
                        'valide' => 1,
                        'updated_at' => now(),
                    ]);

            }

            $facture = DB::table('client')
                ->leftJoin('tauxes', 'client.tauxes', '=', 'tauxes.id')
                ->leftJoin('assurance', 'assurance.code', '=', 'client.assurance')
                ->leftJoin('societe_assurance', 'societe_assurance.id', '=', 'client.societe_assurance')
                ->where('client.matricule', '=', $request->client)
                ->select(
                    'client.nomprenom as client',
                    'client.matricule as matricule',
                    'client.datenais as datenais',
                    'client.sondage as sondage',
                    'client.cel as contact',
                    'client.matricule_assurance as matriculeass',
                    'assurance.denomination as assurance',
                    'societe_assurance.libelle as societe',
                    'tauxes.valeur as taux',
                )
                ->first();

            if ($facture) {
                $clientData = [
                    'code' => $code,
                    'assurance' => $facture->assurance,
                    'societe' => $facture->societe,
                    'matriculeass' => $facture->matriculeass,
                    'client' => $facture->client, 
                    'contact' => $facture->contact, 
                    'date' => now(),
                    'matricule' => $facture->matricule,
                    'sondage' => $facture->sondage,
                    'datenais' => $facture->datenais,
                    'total' => $request->total, 
                    'partclient' => $request->netPayer, 
                    'taured' => $request->remise, 
                    'partassurance' => $request->netAssurance,
                    'reste' => $request->netPayer ?? 0,
                    'payer' => 0,
                    'taux' => $facture->taux ?? 0
                ];
            } else {
                $clientData = []; // Si aucun client trouvé, on renvoie un tableau vide
            }


            $facture_pres = DB::table('prescriptions')
                ->where('matricule', '=', $request->client)
                ->select(
                    'OD',
                    'OG',
                )
                ->first();

            if ($facture_pres) {
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
            } else {
                $pres = []; // Si aucune prescription trouvée, on renvoie un tableau vide
            }

            $produits = !empty($selections) ? $selections : [];

            $fac = ($facture && $facture_pres && !empty($produits)) ? 1 : 0;

            // Valider la transaction
            DB::commit();
            return response()->json(
                [
                    'success' => true, 
                    'message' => 'Opération éffectuée',
                    'client' => $clientData,
                    'pres' => $pres,
                    'produits' => $produits,
                    'fac' => $fac,
                ]);

        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function insert_operation(Request $request, $id_agence, $login)
    {

        $verf = DB::table('porte_caisses')->where('id', '=', 1)->select('statut','solde')->first();

        if ($verf && $verf->statut == 0) {
            return response()->json(['caisser_fermer' => true]);
        }


        DB::beginTransaction();

        try {

            $num = $this->generateUniqueNumeroOperation();

            $montant = $verf->solde;

            if ($request->type == 'entree') {
                $typeop = 3;

                $montant += $request->montant;

            } else if ($request->type == 'sortie') {
                $typeop = null;

                if ($verf && $request->montant > $verf->solde) {
                    return response()->json(['montant' => true]);
                }

                $montant -= $request->montant;
            }

            $updateData = [
                'solde' => $montant,
                'updated_at' => now(),
            ];

            $Updated = DB::table('porte_caisses')
                ->where('id', '=', 1)
                ->update($updateData);

            if ($Updated == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table porte_caisses');
            }

            $Inserted = DB::table('caisse')->insert([
                'type' => $request->type,
                'libelle' => $request->motif,
                'montant' => (int) $request->montant,
                'magasin' => $id_agence,
                'dateop' => $request->dateop,
                'datecreat' => now(),
                'heure_crea' => now(),
                'login' => $login,
                'code_client' => null,
                'type_operation' => $typeop,
                'num_operation' => $num,
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
