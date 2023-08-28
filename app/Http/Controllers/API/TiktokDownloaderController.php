<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class TiktokDownloaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        return response()->json(['pesan'=>'gagal | id video tidak ditemukan | contoh request : /api/tiktok/7264413619281795842',
        'status'=>200,
        'nama_apikey'=>$userApiKey->nama], 200);
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
    public function show(string $id, Request $request)
    {
        try {
            $apikeyheaders = $request->header('apikey');
            $userApiKey = User::where('apikey', $apikeyheaders)->first();
            $httpreq = new Client();
            $reqapi = $httpreq->request('GET', 'https://api16-normal-c-useast1a.tiktokv.com/aweme/v1/feed/?aweme_id='.$id);
            $dataTiktok = json_decode($reqapi->getBody(), true);
            $validateID = $dataTiktok["aweme_list"][0]["aweme_id"]; 
            $authortt = $dataTiktok["aweme_list"][0]["author"]["nickname"];
            $avatar_authortt = $dataTiktok["aweme_list"][0]["author"]["avatar_medium"]["url_list"][0];
            $titlett = $dataTiktok["aweme_list"][0]["desc"];
            $musictt = $dataTiktok["aweme_list"][0]["music"]["play_url"]["url_list"][0];
            $videonowmtt = $dataTiktok["aweme_list"][0]["video"]["play_addr"]["url_list"][0];
            $videowmtt = $dataTiktok["aweme_list"][0]["video"]["download_addr"]["url_list"][0];

            if($validateID === $id) {
                return response()->json([             
                'pesan'=>'sukses',
                'status'=>200,
                'nama_apikey'=>$userApiKey->nama,
                'data'=>['author_name'=>$authortt,'author_avatar'=>$avatar_authortt,'title_video'=>$titlett,'music_video'=>$musictt,'video_nowm'=>$videonowmtt,'video_wm'=>$videowmtt]
                ], 200);
            } else {
                return response()->json([             
                'pesan'=>'sukses',
                'status'=>400,
                'nama_apikey'=>$userApiKey->nama,
                'data'=>'gagal | Data ID tidak ditemukan :('], 400);
            }
        } catch(ClientException $err) {
            return response()->json([             
                'pesan'=>'sukses',
                'status'=>400,
                'nama_apikey'=>$userApiKey->nama,
                'error'=>'Something went wrong | '.$err->getResponse()->getBody().' | '.$err->getResponse()->getStatusCode()], 400);
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
