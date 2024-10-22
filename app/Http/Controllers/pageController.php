<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class pageController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
  
    public function dashboard()
    {
        $usernameAuth = Auth::user()->nama;
        return view('/page/dashboard')->with(['userName' => $usernameAuth]);
    }


    public function docs()
    {
        $apiLists = json_decode(file_get_contents('jsonAPI/docs.json'), true);
        return view('/page/docs')->with([
            'apiLists'=>$apiLists
        ]);
    }

    public function about()
    {
        $contributor = json_decode(file_get_contents('jsonAPI/contributor.json'), true);
        return view('/page/about')->with([
            'contributors'=>$contributor
        ]);
    }

    public function profil()
    {
        $nama = Auth::user()->nama;
        $nohp = Auth::user()->nohp;
        $email = Auth::user()->email;
        $apikey = Auth::user()->apikey;
        $wlip = Auth::user()->wlip;

        return view('/page/profil')->with([
            'nama' => $nama,
            'nohp' => $nohp,
            'email' => $email,
            'apikey' => $apikey,
            'wlip' => $wlip
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'nama' => ['required','regex:/^[A-Za-z\s]*$/','string','max:100'],
            'nohp' => ['required','regex:/^(\+62|62|0)8[1-9][0-9]{6,10}$/','string','min:9','max:14','unique:users,nohp,' . $user->id],
            'email' => 'required|string|email|max:100|unique:users,email,' . $user->id,
            'g-recaptcha-response' => 'required|captcha',
            'apikey' => 'required|min:32|max:32|string|unique:users,apikey,' . $user->id,
            'wlip'=> ['nullable','max:255','regex:/((25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)(,|,?$))/']

        ], [
            'nama.required' => 'Harap isi nama terlebih dahulu!',
            'nama.regex'=>'Nama hanya boleh huruf!',
            'nama.max' => 'Harap masukkan maximal 100 karakter!',
            'nohp.unique' => 'Mohon maaf No.HP telah terdaftar sebelumnya!',
            'nohp.min' => 'No HP minimal 10 angka!',
            'nohp.max' => 'No HP maximal 13 angka!',
            'nohp.regex' => 'Format No HP salah! [0878xxxxxxxx]',
            'email.required' => 'Harap mengisi email terlebih dahulu!',
            'email.email' => 'Email tidak valid!!',
            'email.unique' => 'Email sudah pernah terdaftar!',
            'email.max' => 'Harap masukkan maximal 100 karakter',
            'g-recaptcha-response.required' => 'Mohon untuk menyelesaikan captcha terlebih dahulu!',
            'apikey.min' => 'Harap masukkan minimamal 32',
            'apikey.max' => 'Harap masukkan maximal 32',
            'wlip.regex' => 'Format IP salah!',
            'wlip.max' => 'IP terlalu banyak, max 255 karakter!'
        ]);


        $user->update([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'apikey' => $request->apikey,
            'wlip' => $request->wlip
        ]);

        // Redirect back with a success message
        return redirect()->route('profil')->with('success', 'Profil Berhasil Di Update!');
    }



    public function gantiPassword()
    {
        return view('/page/update', ['user' => Auth::user()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required'],
            'password_confirmation' => ['same:password'],
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Mohon untuk menyelesaikan captcha terlebih dahulu!',
            'old_password.required' => 'Harap isi password lama!',
            'password.required' => 'Harap isi password baru!',
            'password.same' => 'Password baru tidak boleh sama dengan password lama!',
            'password_confirmation.required' => 'Harap isi konfirmasi password!'
        ]);

        if(Hash::check($request->old_password , auth()->user()->password)) {
            if(!Hash::check($request->password, auth()->user()->password)) {
                $user = auth()->user();
                $user->update(['password' => Hash::make($request->password)]);
                return redirect()->intended('/profil')->with('success', 'Berhasil ganti password✔');
            } else {
                return redirect()->back()->withErrors('Password tidak boleh sama dengan sebelumnya!');
            }
        } else {
            return redirect()->back()->withErrors('Password lama salah!');
        }


    }

}


