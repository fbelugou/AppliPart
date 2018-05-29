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

    public function username()
    {
        return 'sAMAccountName';
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('sAMAccountName', 'password');

        if (Auth::attempt($credentials)) {



            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }

    protected function authenticated(Request $request, $user)
   {
        if(!($user->objectclass[1]=="person" && (strpos($user->distinguishedname[0],'stgIUT') !== false || strpos($user->distinguishedname[0],'Formation') !== false || strpos($user->distinguishedname[0],'Administration') !== false || strpos($user->distinguishedname[0],'Exploitation') !== false) )){
            $this->logout($request);
        }
   }
}
