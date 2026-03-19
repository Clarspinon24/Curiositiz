<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        if (! $user->verified) {
            auth()->logout();
            return back()->with('warning', 'Vous devez confirmer votre compte en cliquant sur le lien reçu par email !');
        }

        return redirect()->intended($this->redirectPath());
    }

    public function verifyAccountReSendEmail()
    {
        echo 'Erreur: veuillez contacter un administrateur du site';
    }
}
