<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Fonction de récupération du champ d'identification sur l'active directory
    public function username()
    {
        //Nom du champ d'identification sur l'active directory
        return 'sAMAccountName';
    }

    //Fonction d'identification
    public function authenticate(Request $request)
    {
        //Récupération de l'identifiant et du mot de passe
        $credentials = $request->only('sAMAccountName', 'password');
        //Tentative de connection
        if (Auth::attempt($credentials)) {
            // Redirection vers l'url demandée si l'utilisateur à réussi à se connecter
            return redirect()->intended('dashboard');
        }
    }

    //Fonction de vérification de l'utilisation après authentification
    protected function authenticated(Request $request, $user)
   {
        //Tri des utilisateurs selon leurs groupe sur l'active directory
        //On vérifie si l'utilisateur est une personne puis
        //On vérifie si dans la liste des groupes de l'utilisateur on trouve un des groupes autorisés à se connecter
        if(!($user->objectclass[1]=="person" && (strpos($user->distinguishedname[0],'stgIUT') !== false || strpos($user->distinguishedname[0],'Formation') !== false || strpos($user->distinguishedname[0],'Administration') !== false || strpos($user->distinguishedname[0],'Exploitation') !== false) )){
            //Déconnecte l'utilisateur si il n'est pas autorisé à utiliser l'application
            $this->logout($request);
        }
   }
}
