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

use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::User()) {
            return redirect()->route('tableau_bord');
        }

        return view('pages.auth.login');
    }

    public function deconnecter(Request $request)
    {
        $user = Auth::User();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function trait_login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        $user = User::where('login', $login)->first();

        if (Auth::attempt(['login' => $login, 'password' => $password])) {

            // Récupérer le profil utilisateur
            $magasin = DB::table('magasin')->where('id', '=', $user->magasin_id)->first();

            if ($magasin) {
                session()->put('user_magasin', $magasin->nom);
            }

            $service = DB::table('service')->where('id', '=', $user->service_id)->first();

            if ($service) {
                session()->put('user_service', $service->libelle);
            }

            return response()->json([
                'success' => true,
                'login' => Auth::User()->login,
            ]);
        }

        return response()->json(['error' => true, 'login' => $login,'password' => $password]);
    }

}
