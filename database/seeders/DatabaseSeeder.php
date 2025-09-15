<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // DB::table('porte_caisses')->insert(['solde' => '0','statut' => 0,'created_at' => now(),'updated_at' => now()]);

        $caisse = DB::table('caisse')->select('caisse.*')->get();
        foreach ($caisse as $value) {

            $dateop = date('Y-m-d', strtotime($value->dateop)).' '.$value->heure_crea;
            $datecreat = date('Y-m-d', strtotime($value->datecreat)).' '.$value->heure_crea;

            $updateDataop = [
                'dateop' => $dateop,
                'created_at' => $datecreat,
                'updated_at' => $datecreat,
            ];

            $Updated = DB::table('caisse')
                ->where('codeop', '=', $value->codeop)
                ->update($updateDataop);

            if ($value->mail == 0 || $value->mail == null) {
                DB::table('caisse')
                    ->where('codeop', '=', $value->codeop)
                    ->update([
                        'mail' => 1,
                        'updated_at' => now(),
                    ]);
            }

            if ($value->type_operation == 4 || $value->type_operation == 5) {
                
                $updateData1 = [
                    'type' => null,
                    'mail' => null,
                    'updated_at' => now(),
                ];

                $Updated1 = DB::table('caisse')
                    ->where('codeop', '=', $value->codeop)
                    ->update($updateData1);

            }

            // if ($value->type == 'entree') {
                
            //     DB::table('caisse')->where('codeop', $value->codeop)->update([
            //         'type_operation' => 0,
            //         'updated_at' => now()
            //     ]);

            // } else if ($value->type == 'sortie') {

            //     DB::table('caisse')->where('codeop', $value->codeop)->update([
            //         'type_operation' => 0,
            //         'updated_at' => now()
            //     ]);

            // }
            
        }

        $masagins = DB::table('magasin')->get();
        foreach ($masagins as $value) {
            
            $solde = 0;
            $caisse = DB::table('caisse')->where('magasin', $value->id)->select('caisse.*')->get();
            foreach ($caisse as $valuee) {
                if ($valuee->type == 'entree' ) {
                    $solde += $valuee->montant;
                } else if ($valuee->type == 'sortie' ) {
                    $solde -= $valuee->montant;
                }
            }

            DB::table('porte_caisses')->insert([
                'solde' => $solde,
                'statut' => 0,
                'magasin' => $value->id, 
                'created_at' => now(),
                'updated_at' => now()
            ]); 

            // DB::table('porte_caisses')->where('magasin', $value->id)->update([
            //     'solde' => $solde,
            //     'statut' => 0,
            //     'updated_at' => now()
            // ]); 

        }

        DB::table('users')->insert([
            [
                'name' => 'ADMIN',
                'login' => 'admin',
                'email' => null,
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'tel' => null,
                'magasin_id' => 1,
                'service_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'JOB OPTIQUE PLATEAU',
                'login' => 'joboptique',
                'email' => null,
                'password' => password_hash('joboptique', PASSWORD_BCRYPT),
                'tel' => 0101010101,
                'magasin_id' => 1,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marcory 1',
                'login' => 'marcory1',
                'email' => null,
                'password' => password_hash('marcory1', PASSWORD_BCRYPT),
                'tel' => 0101010101,
                'magasin_id' => 2,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marcory 2',
                'login' => 'marcory2',
                'email' => null,
                'password' => password_hash('marcory2', PASSWORD_BCRYPT),
                'tel' => 01010101,
                'magasin_id' => 2,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plateau 1',
                'login' => 'plateau1',
                'email' => null,
                'password' => password_hash('plateau1', PASSWORD_BCRYPT),
                'tel' => 01010101,
                'magasin_id' => 1,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plateau 2',
                'login' => 'plateau2',
                'email' => null,
                'password' => password_hash('plateau2', PASSWORD_BCRYPT),
                'tel' => 01010101,
                'magasin_id' => 1,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yopougon 1',
                'login' => 'yopougon1',
                'email' => null,
                'password' => password_hash('yopougon1', PASSWORD_BCRYPT),
                'tel' => 0101010101,
                'magasin_id' => 3,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yopougon 2',
                'login' => 'yopougon2',
                'email' => null,
                'password' => password_hash('yopougon2', PASSWORD_BCRYPT),
                'tel' => 01010101,
                'magasin_id' => 3,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        for ($i = 5; $i <= 100; $i += 5) { 
            DB::table('tauxes')->insert([
                'valeur' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]); 
        }

        $clients = DB::table('client')
            ->leftJoin('societe_assurance', 'societe_assurance.id', '=', 'client.societe_assurance')
            ->leftJoin('assurance', 'assurance.code', '=', 'societe_assurance.code_assurance')
            ->Join('utilisa', 'utilisa.login', '=', 'client.login')
            ->select(
                'client.societe_assurance as client_societe',
                'client.matricule as client_matricule',
                'societe_assurance.taux_couverture as taux',
                'assurance.code as assurance_code',
                'utilisa.magasin as magasin_id',
            )
            ->get();
        foreach ($clients as $value) {

            $updateD =[
                'magasin' => $value->magasin_id,
                'updated_at' => now(),
            ];

            $UpdateM = DB::table('client')
                ->where('matricule', '=', $value->client_matricule)
                ->update($updateD);
            
            if ($value->client_societe != null) {
                
                $updateData =[
                    'assurance' => $value->assurance_code,
                    'tauxes' => 16,
                    'magasin' => $value->magasin_id,
                    'updated_at' => now(),
                ];

                $Update = DB::table('client')
                    ->where('matricule', '=', $value->client_matricule)
                    ->update($updateData);

            }
        }

        $prospects = DB::table('prospect')
            ->leftJoin('societe_assurance', 'societe_assurance.id', '=', 'prospect.societe_assurance')
            ->leftJoin('assurance', 'assurance.code', '=', 'societe_assurance.code_assurance')
            ->select(
                'prospect.societe_assurance as prospect_societe',
                'prospect.code as prospect_code',
                'societe_assurance.taux_couverture as taux',
                'assurance.code as assurance_code',
            )
            ->get();
        foreach ($prospects as $value) {
            
            if ($value->prospect_societe != null) {
                
                $updateData =[
                    'assurance' => $value->assurance_code,
                    'tauxes' => 16,
                    'updated_at' => now(),
                ];

                $Update = DB::table('prospect')
                    ->where('code', '=', $value->prospect_code)
                    ->update($updateData);

            }
        }

        $vente = DB::table('vente')->select('code', 'total', 'partassurance', 'taured')->get();
        foreach ($vente as $value) {
            $montant = $value->total; // Par défaut, le montant = total

            if ($value->partassurance !== null) {
                $montant -= $value->partassurance; // Déduire la part assurance
            } elseif ($value->taured !== null) {
                $montant -= ($value->total * $value->taured) / 100; // Appliquer la réduction
            }

            DB::table('vente')
                ->where('code', '=', $value->code) // Correction ici
                ->update([
                    'partclient' => abs($montant), // Abs pour éviter les négatifs
                    'updated_at' => now(),
                ]);
        }

        $vente = DB::table('vente')->select('code', 'partclient','payer', 'login')->get();
        foreach ($vente as $value) {
            $partclient = $value->partclient;
            $total_verser = 0;

            // Corrected query: Use 'where' instead of incorrect 'select'
            $ver = DB::table('versement')
                ->where('achat', '=', $value->code) // Fix applied here
                ->select('montant')
                ->get();

            if ($ver->isEmpty()) {
                DB::table('vente')
                    ->where('code', '=', $value->code)
                    ->update([
                        'reste' => $partclient,
                        'payer' => $total_verser,
                        'updated_at' => now(),
                    ]);
            } else {
                foreach ($ver as $val) {
                    $total_verser += $val->montant;
                }

                $montant = abs($partclient - $total_verser);

                DB::table('vente')
                    ->where('code', '=', $value->code)
                    ->update([
                        'reste' => $montant,
                        'payer' => $total_verser,
                        'updated_at' => now(),
                    ]);
            }

            if ($value->partclient == $value->payer) {
                DB::table('vente')
                    ->where('code', '=', $value->code)
                    ->update([
                        'regle' => 1,
                        'updated_at' => now(),
                    ]);
            }

            $id = DB::table('utilisa')
                ->join('magasin', 'magasin.id', '=', 'utilisa.magasin')
                ->where('utilisa.login', '=', $value->login)
                ->select('magasin.id as magasin_id')
                ->first();

            if ($id) {
                DB::table('vente')
                    ->where('code', '=', $value->code)
                    ->update([
                        'magasin' => $id->magasin_id,
                        'updated_at' => now(),
                    ]);
            }
        }

        $proforma = DB::table('proforma')->select('login', 'code')->get();
        foreach ($proforma as $value) {

            $id = DB::table('utilisa')
                ->join('magasin', 'magasin.id', '=', 'utilisa.magasin')
                ->where('utilisa.login', '=', $value->login)
                ->select('magasin.id as magasin_id')
                ->first();

            if ($id) {
                DB::table('proforma')
                    ->where('code', '=', $value->code)
                    ->update([
                        'magasin' => $id->magasin_id,
                        'updated_at' => now(),
                    ]);
            }
        }

    }
}
