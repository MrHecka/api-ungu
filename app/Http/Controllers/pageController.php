<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class pageController extends Controller implements Rule
{
  
    public function dashboard()
    {
        $usernameAuth = Auth::user()->nama;
        return view('/page/dashboard')->with(['userName' => $usernameAuth]);
    }


    public function docs()
    {
        $apiLists = json_decode(file_get_contents('jsonAPI/docs'), true);
        return view('/page/docs')->with([
            'apiLists'=>$apiLists
        ]);
    }

    public function profil()
    {
        $nama = Auth::user()->nama;
        $nohp = Auth::user()->nohp;
        $email = Auth::user()->email;
        $apikey = Auth::user()->apikey;

        return view('/page/profil')->with([
            'nama' => $nama,
            'nohp' => $nohp,
            'email' => $email,
            'apikey' => $apikey

        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        // Validate the input data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nohp' => 'required|string|max:13|unique:users,nohp,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'g-recaptcha-response' => 'required|captcha',
            'apikey' => 'required|min:32|max:32|string|unique:users,apikey,' . $user->id
            // Add more validation rules as needed
        ], [
            'nama.required' => 'Nama nya diisi dulu oyy😡',
            'nama.max' => 'Harap masukkan maximal 255😡',
            'nohp.unique' => 'No. HP udah pernah terdaftar woyyy jan menuhin DB😡',
            'nohp.max' => 'No hp maximal 13',
            'email.required' => 'Email nya diisi dulu oyy😡',
            'email.email' => 'Email tidak valid woyyyy😡',
            'email.unique' => 'Email sudah pernah terdaftar',
            'email.max' => 'Harap masukkan maximal 255',
            'g-recaptcha-response.required' => 'Isi captcha dulu woyy dasar bot😡',
            'apikey.min' => 'Harap masukkan minimamal 32',
            'apikey.max' => 'Harap masukkan maximal 32',
        ]);

        // Update the user's profile data
        $user->update([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'apikey' => $request->apikey,
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
            'g-recaptcha-response.required' => 'Isi captcha dulu woyy dasar bot😡',
            'old_password.required' => 'Harap isi password lama😡',
            'password.required' => 'Harap isi password baru😡',
            'password.same' => 'Password baru tidak boleh sama dengan password lama!',
            'password_confirmation.required' => 'Harap isi konfirmasi password😡'
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

}
