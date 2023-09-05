<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class gunungberapiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apikeyheaders = $request->header('apikey');
        $userApiKey = User::where('apikey', $apikeyheaders)->first();
        $allgunung = json_decode(file_get_contents("jsonAPI/gunungapi.json"), true);
        return response()->json([
            'pesan' => 'sukses',
            'status' => 200,
            'nama_apikey' => $userApiKey->nama,
            'data' => $allgunung
        ], 200);
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
