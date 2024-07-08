<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EleveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Session::put('target', FacadesRequest::fullUrl());
        if ($request->user()?->eleve && $request->user()->statut === 'etudiant') return $next($request);
        return to_route('user.login.form');
    }
}
