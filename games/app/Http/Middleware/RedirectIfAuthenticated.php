<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Si el usuario es administrador, redirigir al panel de administración
                if (Auth::guard($guard)->user()->admin) {
                    return redirect('/admin/dashboard');
                }
                // Si es un usuario normal, redirigir a la página principal
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
} 