<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->currentLogger['email'], 'password' => $request->currentLogger['mdp']])){
            return ['redirect' => '/#/listOrder/'.Auth::id()];
        } else {
            //Marche Pas //flash('Votre email ou mot de passe est incorrect, veuillez ressayer')->warning();
            return ['redirect' => '/#/login'];
        }
        
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function notLogged(){
        return redirect('/#/login');
    }

}
