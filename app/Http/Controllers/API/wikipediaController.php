<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class wikipediaController extends Controller
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
            $reqapi = $httpreq->request('GET', 'https://id.wikipedia.org/wiki/Wikipedia:Tahukah_Anda');
            $htmlString = (string) $reqapi->getBody();
            libxml_use_internal_errors(true);
            $doc = new DOMDocument();
            $doc->loadHTML($htmlString);
            $xpath = new DOMXPath($doc);
            $getText = $xpath->evaluate('//div[@class="mw-parser-output"]//li');
            $arrayText = [];
            foreach ($getText as $texts) {
                if (preg_match('/(?<=\... ).*/', $texts->textContent.PHP_EOL, $group)) {
                    $arrayText[] = $group[0];
                }
            }

            return response()->json([
                'pesan'=>'sukses',
                'status'=>200,
                'source' => 'https://id.wikipedia.org/wiki/Wikipedia:Tahukah_Anda',
                'nama_apikey'=>$userApiKey->nama,
                'data'=>$arrayText]
                , 200);
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
