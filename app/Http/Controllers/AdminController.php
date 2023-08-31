<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if (strlen($katakunci)) {
            $data = User::where('nama', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")->orWhere('email', 'like', "%$katakunci%")->paginate($jumlahbaris);
        } else {

            $data = User::orderBy('nama', 'desc')->paginate($jumlahbaris);
        }
        return view('page.admin')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('id', $id)->first();
        return view('page.admin')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'nama' => 'required',
            'nohp' => 'required',
            'email' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nohp.required' => 'Jurusan wajib diisi',
            'email.required' => 'Jurusan wajib diisi',
        ]);
        $data = [
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email,
        ];
        User::where('id', $id)->update($data);
        return redirect()->to('page.admin')->with('success', 'Berhasil update user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->to('/admin')->with('success', 'Berhasil delete user');
    }
}
