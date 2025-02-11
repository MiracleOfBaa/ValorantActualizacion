<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Comprobar si el usuario está autenticado y tiene el rol 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }


        // Si no tiene el rol de 'admin', redirigir a otra página o mostrar un error
        return redirect()->route('home')->with('error', 'No tienes acceso');
    }
}
