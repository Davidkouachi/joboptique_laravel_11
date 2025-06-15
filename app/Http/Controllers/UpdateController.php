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

class UpdateController extends Controller
{

    public function update_type_message(Request $request, $id)
    {

        DB::beginTransaction();

        try {

            $Updated = DB::table('type_messages')->where('id', $id)->update([
                'type' => $request->type,
                'message' => $request->message,
                'updated_at' => now(),
            ]);

            if ($Updated == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table type_messages');
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function update_password(Request $request)
    {

        DB::beginTransaction();

        try {

            $Updated = DB::table('utilisa')->where('login', $request->login)->update([
                'mdp' => $request->mdp1,
                'updated_at' => now(),
            ]);

            if ($Updated == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table utilisa');
            }

            $Updated2 = DB::table('users')->where('login', $request->login)->update([
                'password' => password_hash($request->mdp1, PASSWORD_BCRYPT),
                'updated_at' => now(),
            ]);

            if ($Updated2 == 0) {
                throw new Exception('Erreur lors de l\'insertion dans la table users');
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Opération éffectuée']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

}
