<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $eleve=$request->user()->eleve;
        if($eleve->token!=="verified") return to_route('user.otp.form');
        elseif(! $eleve->is_active) return to_route('user.pricing');
        return $next($request);
    }
}
