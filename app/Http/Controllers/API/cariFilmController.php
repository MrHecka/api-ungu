<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class cariFilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        return response()->json([
        'pesan'=>'Film Tidak Ditemukan | contoh request : [GET] /api/film/cari/?q=John+Wick','status'=>200,
        'nama_apikey'=>$userApiKey->nama]
        , 200);
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
    public function show(Request $request)
    {
        try {
            $apikeyheaders = $request->header('apikey');
            $userApiKey = User::where('apikey', $apikeyheaders)->first();
            $httpreq = new Client();
            $getIDFilm = str_replace(" ", "+", $request->q);
            $reqapi = $httpreq->request('GET', 'https://api.themoviedb.org/3/search/movie?query='.$getIDFilm.'&api_key='.env('APITMDB'));
            return response()->json([
                'pesan'=>'sukses',
                'status'=>200,
                'nama_apikey'=>$userApiKey->nama,
                'linkgambar'=>'https://image.tmdb.org/t/p/w500/{idgambar}',
                'data'=>json_decode($reqapi->getBody())], 200);
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
