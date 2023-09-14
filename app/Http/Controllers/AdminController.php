<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function index(Request $request)
    {
        $total_logins = User::where('last_activity','>',now()->subMinutes(5)->getTimestamp())->get();
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if (strlen($katakunci)) {
            $data = User::where('nama', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")->orWhere('email', 'like', "%$katakunci%")->paginate($jumlahbaris);
        } else {
            $data = User::orderBy('nama', 'desc')->paginate($jumlahbaris);
        }

        if(!json_decode(json_encode($data), true)['data']) {
            return redirect()->to('/admin')->withErrors('Data tidak ditemukan!');
        }

        return view('page.admin')->with([
            'data' => $data,
            'logs_login' => $total_logins
        ]);
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
        $listUser = User::find($id);
        return response()->json([
            'status'=>200,
            'UserDetails'=>$listUser
        ]);
    }



    public function edit($id)
    {
     
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
            'is_dewa'=> $request->roles,
            'email_verified_at'=> $request->verifyEmail,
        ];

        User::where('id', $request->userId)->update($data);

        return redirect()->to('/admin')->with('success', 'Berhasil update user');
    }



    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->to('/admin')->with('success', 'Berhasil delete user');
    }

}
