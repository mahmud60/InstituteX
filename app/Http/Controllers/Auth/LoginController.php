<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    protected $redirectTo = '/home';

    protected function redirectTo()
    {
        if (Auth::user()->user_type == 2) {
            return '/admin';
        }
        return '/home';
    }

    /*protected function authenticated(Request $request, $user)
    {
        if($user->hasRole('admin'))
        {
            return redirect('/admin');
        }

        if($user->hasRole('user'))
        {
            return redirect('/admin');
        }
    }*/



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
