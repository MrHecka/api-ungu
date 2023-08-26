<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ApiMhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        return response()->json(['pesan'=>'mahasiswa tidak ditemukan | contoh request : /api/carimahasiswa/budi','status'=>200,'nama_apikey'=>$userApiKey->nama], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $mhs, Request $request)
    {
        try {
            $apikeyheaders = $request->header('apikey');
            $userApiKey = User::where('apikey', $apikeyheaders)->first();
            $httpreq = new Client();
            $reqapi = $httpreq->request('GET', 'https://api-frontend.kemdikbud.go.id/hit_mhs/'.$mhs);
            $result = json_decode($reqapi->getBody());
            return response()->json(['pesan'=>'sukses','status'=>200,'nama_apikey'=>$userApiKey->nama,'source'=>'https://pddikti.kemdikbud.go.id','data'=>$result]);
        } catch(ClientException $err) {
            return response()->json(['pesan'=>'gagal','status'=>404,'nama_apikey'=>$userApiKey->nama,'error'=>'Server down | '.$err->getResponse()->getBody().' | '.$err->getResponse()->getStatusCode()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
