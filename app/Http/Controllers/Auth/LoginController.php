<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    //protected $redirectTo = '/home';
    protected function redirectTo()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            //dd("Redirection de l'admin");
            return redirect()->route('marques.index');
        } else {
           // dd("Redirection de l'utilisateur non admin");
            return Session::get('url.intended', '/');
        }
    }
    protected function authenticated(Request $request, $user)
{
    if ($user->isAdmin()) {
        return redirect()->route('marques.index');
    }
    return redirect()->intended($this->redirectPath());
}

    
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        // Store the previous URL in the session
        Session::put('url.intended', url()->previous());

        return view('auth.login');
    }

}
