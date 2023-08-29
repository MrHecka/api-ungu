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
        $userWhitelistIP = User::where('apikey', $apikeyheaders)->first();
        
        // CHECKING APIKEY ON HEADERS
        if(strlen($userApiKey) === 0) {
            return response()->json(['pesan'=>"API Key Tidak Ditemukan | masukkan apikey di headers dengan format : {'apikey' : 'apikeyanda'}", 'status' => 401], 401);
        }

        $ArrayWhitelistIP = explode(",",json_decode($userWhitelistIP, true)['wlip']);
        // BLOCK IP NON WHITELIST
        if(!in_array($request->ip(), $ArrayWhitelistIP) && $ArrayWhitelistIP[0] !== "") {
            return response()->json(['pesan'=>"Mohon Maaf IP Tidak Terdaftar | harap masukkan ip anda ke dalam whitelist terlebih dahulu", 'status' => 404], 404);
        }

        // IJININ AKSES API
        return $next($request);
    }
}

