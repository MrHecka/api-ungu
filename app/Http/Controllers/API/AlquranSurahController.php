<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AlquranSurah;
use App\Models\User;
use Illuminate\Http\Request;

class AlquranSurahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        $Alldata = AlquranSurah::all();
        return response()->json(['pesan'=>'sukses | masukkan nomor surah | contoh request : /api/alquran/surah/1',
        'status'=>200,
        'nama_apikey'=>$userApiKey->nama,
        'data'=>$Alldata], 200);
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
        $findSurah = AlquranSurah::find($id);
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        if(!$findSurah) {
            return response()->json(['pesan'=>'gagal',
            'status'=>200,
            'nama_apikey'=>$userApiKey->nama,
            'data'=>'Data tidak ditemukan :('], 400);
        } else {
            return response()->json(['pesan'=>'sukses',
            'status'=>200,
            'nama_apikey'=>$userApiKey->nama,
            'data'=>$findSurah], 200);
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
