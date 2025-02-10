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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CaisseController extends Controller
{
    public function caisseOuvert($id_agence, $login)
    {
        $verf = DB::table('porte_caisses')->where('id', '=', 1)->first();

        if ($verf->statut == 1) {
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        }

        $mail = new PHPMailer(true);
        
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
                'mail' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($Inserted == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table caisse');
            }

            $mail->isHTML(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom(env('MAIL_USERNAME'), 'JOB OPTIQUE');

            // $recipients = [
            //     'lukdio@hotmail.fr',
            //     'myghislainyao@gmail.com',
            // ];

            $recipients = [
                'davidkouachi01@gmail.com',
            ];

            foreach ($recipients as $recipient) {
                $mail->addAddress($recipient);
            }

            $mail->Subject = 'ALERT !';
            $mail->Body = 'OUVERTURE DE LA CAISSE, Solde caisse : '.number_format($caisse->solde, 0, '.', '.').' Fcfa ( par '.$login.' )';
            $mail->send();

            if (!$mail->send()) {
                throw new Exception('Erreur lors de l\'envoi de l\'email : ' . $mail->ErrorInfo);
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
        $verf = DB::table('porte_caisses')->where('id', '=', 1)->first();

        if ($verf->statut == 0) {
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        }

        $mail = new PHPMailer(true);

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
                'mail' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($Inserted == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table caisse');
            }

            $today = Carbon::today();
            $total = 0;
            $entries = 0;
            $exits = 0;

            $transactions = DB::table('caisse')->where('mail', '=', 0)->get();
            
            foreach ($transactions as $value) {
                if ($value->type === 'entree') {
                    $total += (int) $value->montant;
                    $entries += (int) $value->montant;
                } else if ($value->type === 'sortie') {
                    $total -= (int) $value->montant;
                    $exits += (int) $value->montant;
                }
            }

            // -----------------------------------------

            $currentDateTime = Carbon::now()->format('d/m/Y');
            $totalFormatted = number_format($total, 0, ',', '.');
            $entriesFormatted = number_format($entries, 0, ',', '.');
            $exitsFormatted = number_format($exits, 0, ',', '.');

            $tableRows ="";

            foreach ($transactions as $transaction) {

                $color = ($transaction->type === 'entree') ? 'green' : 'red';
                $montant = number_format($transaction->montant, 0, '.', '.');

                $montantFormatted = $transaction->type === 'entree' ? "+ {$montant} Fcfa" : "- {$montant} Fcfa";

                $entryCell = $transaction->type === 'entree' ? "
                    <td style='color: {$color};'>{$montantFormatted}</td>
                    <td></td>
                " : 
                "<td></td>
                <td style='color: {$color};'>{$montantFormatted}</td>";

                $tableRows .= "<tr>
                    <td>{$transaction->libelle}</td>
                    {$entryCell}
                </tr>";
            }

            $totaux ="
                <tr>
                    <th style='text-align: center;'>TOTAUX</th>
                    <th style='color:green; text-align: center;' >+ {$entriesFormatted} Fcfa</th>
                    <th style='color:red; text-align: center;' >- {$exitsFormatted} Fcfa</th>
                </tr>
            ";

            $bilan = '
                <th style="padding: 10px; text-align: center;">BILAN DES OPERATIONS</th>
                <th colspan="2" style="padding: 10px; text-align: center;">' . $totalFormatted . ' Fcfa</th>
            ';

            // -----------------------------------------

            // envoi de email
            $mail->isHTML(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom(env('MAIL_USERNAME'), 'JOB OPTIQUE');
            
            // $recipients = [
            //     'lukdio@hotmail.fr',
            //     'myghislainyao@gmail.com',
            // ];

            $recipients = [
                    'davidkouachi01@gmail.com',
                ];

            foreach ($recipients as $recipient) {
                $mail->addAddress($recipient);
            }

            $mail->Subject = 'ALERT !';

            $mail->Body = "
                <h2>Fermeture de la caisse du {$currentDateTime} : {$totalFormatted} Fcfa</h2>
                <h3>Ci-dessous toutes les opérations de la journée</h3>
                <table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; width: 100%;'>
                    <thead style='background-color: #116aef; color: white;'>
                        <tr>
                            <th style='padding: 10px; text-align: center;'>OPERATION (motif)</th>
                            <th style='padding: 10px; text-align: center;'>ENTREES</th>
                            <th style='padding: 10px; text-align: center;'>SORTIES</th>
                        </tr>
                    </thead>
                    <tbody>
                        {$tableRows}
                    </tbody>
                    <tfoot>
                        {$totaux}
                        <tr style='background-color: #116aef; color: white;'>
                            {$bilan}
                        </tr>
                    </tfoot>
                </table>
            ";

            if (!$mail->send()) {
                throw new Exception('Erreur lors de l\'envoi de l\'email : ' . $mail->ErrorInfo);
            }

            $updateData_mail_envoyer =[
                'mail' => 1,
                'updated_at' => now(),
            ];

            $mail_envoyerUpdate = DB::table('caisse')
                                ->where('mail', '=', 0)
                                ->update($updateData_mail_envoyer);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
}
