<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            Log::info('Usuario no autenticado');
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos de administrador.');
        }

        $user = Auth::user();
        Log::info('Usuario autenticado: ' . $user->email);
        Log::info('Es admin: ' . ($user->is_admin() ? 'Sí' : 'No'));
        Log::info('Valor de admin en DB: ' . ($user->admin ? 'true' : 'false'));

        if (!$user->is_admin()) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos de administrador.');
        }

        return $next($request);
    }
}
