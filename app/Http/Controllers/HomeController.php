<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function about(): View
    {
        return view('about');
    }

    public function showChangePasswordForm(): View
    {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request): RedirectResponse
    {
        if (!Hash::check($request->get('current-password'), Auth::user()->password)) {
            return redirect()->back()->with('error', 'Votre mot de passe actuel est incorrect. Veuillez réessayer.');
        }

        if ($request->get('current-password') === $request->get('new-password')) {
            return redirect()->back()->with('error', 'Le nouveau mot de passe doit être différent du mot de passe actuel.');
        }

        $request->validate([
            'current-password' => 'required',
            'new-password'     => 'required|string|min:6|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect('/profil/' . Auth::user()->id)->with('success', 'Mot de passe modifié avec succès');
    }
}
