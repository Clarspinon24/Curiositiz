<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthSocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirect(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        try {
            $providerUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Erreur lors de la connexion sociale.');
        }

        // Vérifier si l'ID du provider existe déjà
        $user = $this->checkIfProviderIdExists($provider, $providerUser->id);

        if ($user) {
            Auth::login($user, true);
            return redirect('/home');
        }

        // Vérifier si l'email existe déjà
        if ($providerUser->email !== null) {
            $user = User::where('email', $providerUser->email)->first();
            if ($user) {
                $field        = $provider . '_id';
                $user->$field = $providerUser->id;
                $user->save();
                Auth::login($user, true);
                return redirect('/home');
            }
        }

        // Créer un slug unique
        $names = explode(' ', $providerUser->name);
        $firstName = $names[0] ?? 'user';
        $lastName  = $names[1] ?? 'unknown';
        $baseSlug  = strtolower($firstName . '.' . $lastName);
        $slug      = $baseSlug;
        $nb        = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = $baseSlug . $nb;
            $nb++;
        }

        // Créer le nouvel utilisateur
        $user = User::create([
            'name'            => $providerUser->name,
            'email'           => $providerUser->email,
            'image_name'      => $providerUser->avatar,
            'firstname'       => $firstName,
            'lastname'        => $lastName,
            $provider . '_id' => $providerUser->id,
            'slug'            => $slug,
            'cgu'             => 0,
        ]);

        Auth::login($user, true);

        return redirect('/home');
    }

    public function checkIfProviderIdExists(string $provider, string $providerId): ?User
    {
        $field = $provider . '_id';

        return User::where($field, $providerId)->first();
    }
}
