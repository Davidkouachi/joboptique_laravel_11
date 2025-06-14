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


class DeleteController extends Controller
{
    public function delete_type_message($id)
    {
        DB::beginTransaction();

            try {

                $Delete = DB::table('type_messages')
                                ->where('id', '=', $id)
                                ->delete();

                if (!$Delete === 0) {
                    throw new \Exception('Erreur lors de l\'insertion dans type_messages');
                }

                DB::commit();
                return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => true, 'message' => $e->getMessage()]);
            }
    }

    public function delete_fac_proforma($code)
    {
        DB::beginTransaction();

            try {

                $Delete = DB::table('proforma')
                                ->where('code', '=', $code)
                                ->delete();

                if (!$Delete === 0) {
                    throw new \Exception('Erreur lors de la suppression dans proforma');
                }

                DB::commit();
                return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => true, 'message' => $e->getMessage()]);
            }
    }

    public function delete_fac_vente($code)
    {
        DB::beginTransaction();

        try {
            // Supprimer les détails de vente
            $deletedDetails = DB::table('vente_details')
                                ->where('code', $code)
                                ->delete();

            // Supprimer la facture assurance si elle existe
            $deletedFactureAssurance = DB::table('facture_assurance')
                                        ->where('code_vente', $code)
                                        ->delete();

            // Supprimer l'enregistrement principal de vente
            $deletedVente = DB::table('vente')
                            ->where('code', $code)
                            ->delete();

            if ($deletedVente === 0) {
                throw new \Exception('Aucune vente trouvée à supprimer');
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Vente supprimée avec succès']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

}
