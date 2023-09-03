<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{

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


    public function create()
    {
        // 
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        $userData = User::find($id);

        if (!$userData) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }
        return response()->json($userData);
    }



    public function edit($id)
    {
        //  
    }


    public function update(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'nohp' => 'required',
                'email' => 'required',
            ],
            [
                'nama.required' => 'Nama wajib diisi',
                'nohp.required' => 'No HP wajib diisi',
                'email.required' => 'Email wajib diisi',
            ]
        );

        $data = [
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email,
        ];

        User::where('id', $request->userId)->update($data);

        // Mengembalikan respons JSON sebagai confermaasi pembaruan berhasil
        // return response()->json(['message' => 'Data berhasil diperbarui']);
        return redirect()->to('/admin')->with('success', 'Berhasil update user');
    }



    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->to('/admin')->with('success', 'Berhasil delete user');
    }

    public function modal()
    {
        return view('tailwind-modal');
    }
}
