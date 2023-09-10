<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class jadwalSholatController extends Controller
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
            $reqapi = $httpreq->request('GET', 'https://api.myquran.com/v1//sholat/kota/semua');
            return response()->json([
                'pesan' => 'jadwal sholat tidak ditemukan, silahkan mengisi id kota dan tanggal terlebih dahulu! | contoh request : [GET] /api/jadwalsholat/1634/2023/09/05',
                'status' => 404,
                'nama_apikey' => $userApiKey->nama,
                'list_idkota' => json_decode($reqapi->getBody())
            ], 404);
        } catch (ClientException $err) {
            return response()->json([
                'pesan' => 'gagal',
                'status' => 404,
                'nama_apikey' => $userApiKey->nama,
                'error' => 'Something went wrong | ' . $err->getResponse()->getBody() . ' | ' . $err->getResponse()->getStatusCode()
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
    public function show(string $idkota, string $tahun, string $bulan, string $hari, Request $request)
    {
        try {
            $apikeyheaders = $request->header('apikey');
            $userApiKey = User::where('apikey', $apikeyheaders)->first();
            $httpreq = new Client(['timeout' => 20]);
            $reqapi = $httpreq->request('GET', 'https://api.myquran.com/v1/sholat/jadwal/' . $idkota . '/' . $tahun . '/' . $bulan . '/' . $hari);
            return response()->json([
                'pesan' => 'sukses',
                'status' => 200,
                'nama_apikey' => $userApiKey->nama,
                'data' => json_decode($reqapi->getBody())
            ], 200);
        } catch (ClientException $err) {
            return response()->json([
                'pesan' => 'gagal',
                'status' => 404,
                'nama_apikey' => $userApiKey->nama,
                'error' => 'Something went wrong | ' . $err->getResponse()->getBody() . ' | ' . $err->getResponse()->getStatusCode()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
