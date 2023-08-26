<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class apiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        if(strlen($userApiKey) === 0) {
            return response()->json(['pesan'=>"api key tidak ditemukan | masukkan apikey di headers dengan format : {'apikey' : 'apikeyanda'}", 'status' => 401], 401);
        }
        return $next($request);
    }
}
