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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está logado e é um administrador
        if (Auth::check() && Auth::user()->usu_admin == 1) {
            return $next($request); // Permite o acesso se for admin
        }

        // Redireciona se não for admin
        return redirect('/')->with('error', 'Você não tem permissão para acessar esta área.');
    }
}
