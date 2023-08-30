<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Psr7;

class cariAnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        return response()->json([
        'pesan'=>'Anime tidak ditemukan | contoh request : [POST] /api/anime/carianime, lalu upload image ke dalam form-data dengan key=image, atau juga bisa mengirimkan link gambar ke route [GET] /api/anime/carianime/?url=urlgambaranime','status'=>200,
        'nama_apikey'=>$userApiKey->nama]
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $apikeyheaders = $request->header('apikey');
            $userApiKey = User::where('apikey', $apikeyheaders)->first();

            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                'pesan'=>'form-data dengan key=gambar tidak valid | contoh request : [POST] /api/anime/carianime','status'=>404,
                'nama_apikey'=>$userApiKey->nama], 404);
            }

            $image = $request->file('image');
            $source = file_get_contents($image);
            $base64 = base64_encode($source);
            $blob = 'data:'.$image->getMimeType().';base64,'.$base64;

            $httpreq = new Client();
            $uploadFile  = $httpreq->request('POST', 'https://api.trace.moe/search', 
                [
                    'multipart' => [
                        [
                            'name'     => 'file',
                            'filename' => 'blob',
                            'contents' => fopen($image, 'r')
                        ]
                    ]
                ]);
                
            $response = $uploadFile->getBody()->getContents();
            $jsonData = json_decode($response);

            return response()->json([
                'pesan'=>'sukses',
                'status'=>200,
                'nama_apikey'=>$userApiKey->nama,
                'data'=> $jsonData], 200);
        } catch (ClientException $err) {
            return response()->json([
                'pesan'=>'gagal',
                'status'=>404,
                'nama_apikey'=>$userApiKey->nama,
                'error'=>'Something went wrong | '.$err->getResponse()->getBody().' | '.$err->getResponse()->getStatusCode()
            ], 404);
        }
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
            $reqapi = $httpreq->request('GET', 'https://api.trace.moe/search?url='.urlencode($request->url));
            return response()->json([
                'pesan'=>'sukses',
                'status'=>200,
                'nama_apikey'=>$userApiKey->nama,
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
