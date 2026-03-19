<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class profilUncomplet
{
    /**
     * Handle an incoming request.
     *
     * Redirige vers /home si le profil est incomplet (ville, code postal, téléphone manquants).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (empty($user->city) && empty($user->postal) && empty($user->phone)) {
            return redirect('/home');
        }

        return $next($request);
    }
}
