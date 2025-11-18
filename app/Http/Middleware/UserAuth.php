<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{
    $user = $request->user(); // récupère l'utilisateur connecté

    // Si aucun utilisateur connecté, redirige vers login
    if (!$user) {
         return $next($request);
    }

    // Si l'utilisateur est bloqué
    if ($user->is_block) {
        Auth::logout(); // déconnecte l'utilisateur

        // Éviter la boucle de redirection : si on est déjà sur /login, ne pas rediriger encore
            if ($request->routeIs('login') || $request->routeIs('logout')) {
                return $next($request);
            }


        return redirect()->route('login')->with('error', 'Votre compte a été bloqué. Contactez l’administrateur.');
    }

    // Sinon, laisse passer la requête
    return $next($request);
}

}
