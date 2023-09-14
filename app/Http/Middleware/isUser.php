<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()) {
            Auth::user()->timestamps = false;
            Auth::user()->last_activity = now()->getTimestamp();
            Auth::user()->saveQuietly();
            return $next($request);
        }
        return redirect('/')->withErrors('Silahkan Melakukan Login Terlebih Dahulu!');
    }
}
