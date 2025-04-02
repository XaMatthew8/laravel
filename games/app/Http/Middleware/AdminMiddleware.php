<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y es admin
        if (!Auth::check()) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos de administrador.');
        }

        $user = Auth::user();
        if (!$user || !$user->admin) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos de administrador.');
        }

        return $next($request);
    }
}
