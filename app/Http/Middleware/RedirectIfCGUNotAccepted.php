<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCGUNotAccepted
{
    /**
     * Handle an incoming request.
     *
     * Redirige vers la page de validation des CGU si l'utilisateur ne les a pas acceptées.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->hasCgu()) {
            return redirect('/cgu/validate');
        }

        return $next($request);
    }
}
