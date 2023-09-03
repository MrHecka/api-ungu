<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class CekResiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $apikeyheaders = $request->header('apikey');
            $userApiKey = User::where('apikey', $apikeyheaders)->first();
            $httpreq = new Client(['timeout' => 20]);
            $reqapi = $httpreq->request('GET', 'https://api.binderbyte.com/v1/list_courier?api_key='.env('APIRESI'));
            return response()->json([
                'pesan'=>'resi/layanan tidak ditemukan | [GET] contoh request : /api/cekresi/jne?&resi=142080117721233',
                'status'=>200,
                'nama_apikey'=>$userApiKey->nama,
                'listkurir'=>json_decode($reqapi->getBody())], 200);
        } catch(ClientException $err) {
            return response()->json([
                'pesan'=>'gagal',
                'status'=>404,
                'nama_apikey'=>$userApiKey->nama,
                'error'=>'Something went wrong | '.$err->getResponse()->getBody().' | '.$err->getResponse()->getStatusCode()
            ], 404);
        }
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
    public function show(string $service, Request $request)
    {
        try {
            $apikeyheaders = $request->header('apikey');
            $userApiKey = User::where('apikey', $apikeyheaders)->first();
            $httpreq = new Client(['timeout' => 20]);
            $reqapi = $httpreq->request('GET', 'https://api.binderbyte.com/v1/track?api_key='.env('APIRESI').'&courier='.$service.'&awb='.$request->resi);
            return response()->json([
                'pesan'=>'sukses',
                'status'=>200,
                'nama_apikey'=>$userApiKey->nama,
                'data'=>json_decode($reqapi->getBody())->data,
            ], 200);
        } catch(ClientException $err) {
                return response()->json([
                    'pesan'=>'gagal',
                    'status'=>404,
                    'nama_apikey'=>$userApiKey->nama,
                    'error'=>'Something went wrong | '.$err->getResponse()->getBody().' | '.$err->getResponse()->getStatusCode()
                ], 404);
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
