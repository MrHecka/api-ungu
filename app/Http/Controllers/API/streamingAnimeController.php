<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class streamingAnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        return response()->json([
        'pesan'=>'Anime tidak ditemukan | contoh request : [GET] /api/anime/streaminganime/?q=Kimi No Nawa&page=1','status'=>200,
        'nama_apikey'=>$userApiKey->nama]
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $apikeyheaders = $request->header('apikey');
            $userApiKey = User::where('apikey', $apikeyheaders)->first();

            // CHECK IF PARAMETER Q IS EXIST
            if(!strlen($request->q)) {
                return response()->json([
                    'pesan'=>'Parameter query (q) not found.',
                    'status'=>404,
                    'nama_apikey'=>$userApiKey->nama
                ], 404);
            }

            $httpreq = new Client(['timeout' => 20]);
            $reqapi = $httpreq->request('GET', 'https://nimegami.id/?s='.$request->q.'&post_type=post');
            $htmlString = (string) $reqapi->getBody();

            // SCRAPPING DATA LINKS 
            libxml_use_internal_errors(true);
            $crawler = new Crawler($htmlString);
            $arrayHref = [];
            $crawler->filter('body > div.wrapper > div.archive > div.archive-a > article > div.thumbnail > a')->each(function (Crawler $link) use(&$arrayHref) {
                $arrayHref[] = ['link' => $link->attr('href'), 'rating' => explode(' ',$link->text())[0], 'total_eps' => explode(' ', $link->text())[2] ?? '1', 'page' => count($arrayHref)+1];
            });

            // CHECK IF ANIME EXIST
            if(count($arrayHref)===0) {
                return response()->json([
                    'pesan'=>'Mohon maaf, Anime tidak dapat ditemukan :(',
                    'status'=>404,
                    'nama_apikey'=>$userApiKey->nama,
                    'source'=>'https://nimegami.id/'
                ], 404);
            }
            
            // CHECK IF REQUEST TO ONLY Q PARAMETER 
            if(strlen($request->q) && !strlen($request->page)) {
                return response()->json([
                    'pesan'=>'sukses',
                    'status'=>200,
                    'nama_apikey'=>$userApiKey->nama,
                    'source'=>'https://nimegami.id/',
                    'data'=>$arrayHref
                ], 200);
            }

            // CHECK IF REQUEST TO Q AND PAGE PARAMETER
            if(strlen($request->q) && strlen($request->page)) {
                // CHECK IF PARAMETER PAGE IS VALID (NUMBER)
                if(!is_numeric($request->page)) {
                    return response()->json([
                        'pesan'=>'Wrong parameter found.',
                        'status'=>404,
                        'nama_apikey'=>$userApiKey->nama
                    ], 404);
                }

                // CHECK IF PAGE ANIME EXIST
                if(intval($request->page)>count($arrayHref)) {
                    return response()->json([
                        'pesan'=>'Mohon maaf, Anime tidak dapat ditemukan :(',
                        'status'=>404,
                        'nama_apikey'=>$userApiKey->nama,
                        'source'=>'https://nimegami.id/'
                    ], 404);
                }

                // CHECK IF PARAMETER PAGE IS EXIST
                if(!strlen($request->page)) {
                    return response()->json([
                        'pesan'=>'Parameter page not found.',
                        'status'=>404,
                        'nama_apikey'=>$userApiKey->nama
                    ], 404);
                }

                // SCRAPPING DATA
                $selectArr = $arrayHref[intval($request->page)-1];
                $reqapi = $httpreq->request('GET', $selectArr['link']);
                $htmlString = (string) $reqapi->getBody();
                libxml_use_internal_errors(true);
                $crawler = new Crawler($htmlString);
                $judul = $crawler->filter('.title')->text();
                $rating = $selectArr['rating'];
                $total_eps = $selectArr['total_eps'];
                $category = $crawler->filter('.info_a')->text();
                $desc = $crawler->filter('.content > p')->text();
                $arrayBatch = [];
                $crawler->filter('div.batch-dlcuy > ul > li > a')->each(function (Crawler $linkBatchs) use(&$arrayBatch) {
                    $arrayBatch[] = ['title_link' => $linkBatchs->attr('title'), 'link_download' => $linkBatchs->attr('href')];
                });

                
                return response()->json([
                    'pesan'=>'sukses',
                    'status'=>200,
                    'nama_apikey'=>$userApiKey->nama,
                    'source'=>'https://nimegami.id/',
                    'data'=>['judul' => $judul, 'rating' => $rating, 'total_eps' => $total_eps, 'kategori' => $category, 'desc' => $desc, 'data' => $arrayBatch ?? 'Link empty']
                ], 200);
            }
            
        } catch(ClientException $err) {
            $apikeyheaders = $request->header('apikey');
            $userApiKey = User::where('apikey', $apikeyheaders)->first();
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
