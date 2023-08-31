<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class freeEGController extends Controller
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
            $reqapi = $httpreq->request('GET', 'https://store-site-backend-static-ipv4.ak.epicgames.com/freeGamesPromotions?locale=en-US&country=ID&allowCountries=ID');
            $result = json_decode($reqapi->getBody(), true)['data']['Catalog']['searchStore']['elements'];
            $arrayEG = [];

            // GET ALL DATA
            foreach($result as $dataEg) {
                array_push($arrayEG, (object)[
                    'judul' => $dataEg['title'],
                    'deskripsi' => $dataEg['description'],
                    'status' => $dataEg['status'],
                    'gambar' => $dataEg['keyImages'][0]['url'],
                    'link' => 'https://store.epicgames.com/en-US/p/'.$dataEg['urlSlug']
                ]);
            }

            // RETURN RESPONSE AS JSON
            return response()->json([
                'pesan'=>'sukses',
                'status'=>200,
                'nama_apikey'=>$userApiKey->nama,
                'source'=>'https://store.epicgames.com/en-US/free-games/',
                'data'=>$arrayEG
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
