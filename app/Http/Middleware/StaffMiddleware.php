<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Session::put('target',FacadesRequest::fullUrl());
        // dump(FacadesRequest::fullUrl());
        if(!($request->user() && $request->user()->is_staff())) return to_route('admin.enseignant.login.form')->with('error','Operation non permise ');
        return $next($request);
    }
}
