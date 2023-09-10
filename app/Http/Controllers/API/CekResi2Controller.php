<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CekResi2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        $httpreq = new Client(['timeout' => 20]);
        $reqapi = $httpreq->request('GET', 'https://api.binderbyte.com/v1/list_courier?api_key='.env('APIRESI'));
        return response()->json([
            'pesan'=>'resi/layanan tidak ditemukan | [GET] contoh request : /api/v2/cekresi/jne?&resi=142080117721233',
            'status'=>200,
            'nama_apikey'=>$userApiKey->nama,
            'listkurir'=>['jne','sicepat']], 200);
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
        // GET USER API KEY DETAILS
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();

        // ============START CEK RESI HERE============

        // CHECK IF PARAMETER RESI VALID BRO
        if (strlen($request->resi) === 0) {
            return response()->json([
                'pesan'=>'gagal',
                'status'=>404,
                'nama_apikey'=>$userApiKey->nama,
                'error'=>'Resi tidak ditemukan :('
            ], 404);
        }
        
        // JNE CEK RESI
        if(strtolower($service) === "jne") {
            // LETS TRY?
            try {

                // HEADERS CEK RESI
                $hdResi = array(
                    "Accept"=>"text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
                    "Content-Type"=>"application/x-www-form-urlencoded",
                    "Origin" =>"https://www.jne.co.id",
                    "Referer"=>"https://www.jne.co.id/id/beranda",
                    "User-Agent"=>"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.0.0 Safari/537.36"
                );

                // INPUT RESI
                $resi = $request->resi;

                // BYPASS TOKEN AND HOLD SESI GUZZLE GAN!
                $httpreq = new Client(['timeout' => 20, 'cookies' => true]);
                $reqToken = $httpreq->request('GET', 'https://www.jne.co.id/id/beranda', ['headers' => $hdResi]);
                $htmlStrToken = (string) $reqToken->getBody();
                libxml_use_internal_errors(true);
                $crawlerToken = new Crawler($htmlStrToken);
                $finalCSRF = $crawlerToken->filter('input[name=_token]')->attr('value');

                // FORM CEK RESI
                $dataResi = array(
                    "_token" => $finalCSRF,
                    "code" => $resi,
                    "tracking" => ""
                );

                // GET RESI [POST]
                $reqResi = $httpreq->post('https://cekresi.jne.co.id/' . $resi, ['headers' => $hdResi, 'form_params'=> $dataResi]);
                $htmlStrResi = (string) $reqResi->getBody();
                libxml_use_internal_errors(true);
                $crawlerResi = new Crawler($htmlStrResi);

                if (strpos($htmlStrResi, "Airwaybill is not found") !== false) {
                    return response()->json([
                        'pesan'=>'gagal',
                        'status'=>404,
                        'nama_apikey'=>$userApiKey->nama,
                        'error'=>'Resi tidak ditemukan :('
                    ], 404);
                } else {

                    // SUMMARY DETAILS
                    $awb = str_replace("  ","",$crawlerResi->filter('.x_title')->text());
                    $service = trim($crawlerResi->filter('h2[style*="font-weight: bold;"]')->text());
                    $estimate = trim($crawlerResi->filter('h3[style*="font-weight: bold;"]')->text());
                    $shipment_date = trim($crawlerResi->filter('.col-md-4.col-sm-4.col-xs-4.tile h4')->text());
                    
                    // SUMMARY SHIPMENT DETAILS
                    $shipmentDict = [];
                    $crawlerResi->filter('.col-md-12.col-sm-12.col-xs-12.tile')->each(function (Crawler $allShipments) use(&$shipmentDict) {
                        $keyS = str_replace(" ", "_", strtolower(trim($allShipments->filter('span')->text())));
                        $valueS = trim($allShipments->filter('h4')->text());
                        $shipmentDict[$keyS] = $valueS;
                    });

                    // HISTORY ARRAY
                    $historyArr = [];

                    // GET HISTORY STATUS [TRACKING]
                    $crawlerResi->filter('.list-unstyled.timeline.widget')->each(function (Crawler $allHistory) use(&$historyArr) {
                        $history = $allHistory->filter('.title');
                        $date = $allHistory->filter('.byline');
                        $history->each(function(Crawler $fullHistory) use(&$historyArr) {
                            $history_txt = trim($fullHistory->text());
                            $date_txt = trim($fullHistory->siblings()->text());
                            $historyArr[] = array("date" => $date_txt, "history" => $history_txt);
                        });
                    });


                    $allDict = array(
                            "awb" => $awb,
                            "service" => $service,
                            "estimate" => $estimate,
                            "shipment_date" => $shipment_date,
                            "summary" => $shipmentDict,
                            "history_details" => $historyArr
                    );

                    // RESPONSE SUKSES GAN :V
                    return response()->json([
                        'pesan'=>'sukses',
                        'status'=>200,
                        'nama_apikey'=>$userApiKey->nama,
                        'data'=>$allDict,
                    ], 200);

                }

            // CATCH ERROR
            } catch(ClientException $err) {
                return response()->json([
                    'pesan'=>'gagal',
                    'status'=>404,
                    'nama_apikey'=>$userApiKey->nama,
                    'error'=>'Something went wrong | '.$err->getResponse()->getBody().' | '.$err->getResponse()->getStatusCode()
                ], 404);
            }

        // SICEPAT CEK RESI
        } else if(strtolower($service) === "sicepat") {
            
            try {
                $httpreq = new Client(['timeout' => 20]);
                $reqapi = $httpreq->request('GET', 'https://content-main-api-production.sicepat.com/public/check-awb/'.$request->resi, ['http_errors' => false]);

                // CHECK IF ERROR
                if($reqapi->getStatusCode() === 500) {
                    return response()->json([
                        'pesan'=>'gagal',
                        'status'=>404,
                        'nama_apikey'=>$userApiKey->nama,
                        'error'=>'Resi tidak ditemukan :('
                    ], 404);
                }

                $dataSiCepat = json_decode($reqapi->getBody(), true);

                // RESPONSE SUKSES GAN :V
                return response()->json([
                    'pesan'=>'sukses',
                    'status'=>200,
                    'nama_apikey'=>$userApiKey->nama,
                    'data'=>$dataSiCepat["sicepat"]["result"],
                ], 200);

            } catch(ClientException $err) {

                return response()->json([
                    'pesan'=>'gagal',
                    'status'=>404,
                    'nama_apikey'=>$userApiKey->nama,
                    'error'=>'Something went wrong | '.$err->getResponse()->getBody().' | '.$err->getResponse()->getStatusCode()
                ], 404);
            }

        // NOT FOUND EKSPEDISI/SERVICE
        } else {
            return response()->json([
                'pesan'=>'gagal',
                'status'=>404,
                'nama_apikey'=>$userApiKey->nama,
                'error'=>'Ekspedisi tidak ditemukan :('
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
