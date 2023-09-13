<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view("auth/login");
    }

    public function loginGan(Request $request)
    {;
        Session::flash('email', $request->email);

        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ],[
            'email.required'=>'Harap isi Email terlebih dahulu!',
            'password.required'=>'Harap isi Password terlebih dahulu!',
            'g-recaptcha-response.required'=>'Harap mengisi captcha terlebih dahulu ^_^'
        ]);

        $dataLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($dataLogin)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Berhasil Login✔');
        } else {
            return redirect('auth')->withErrors('Email atau Password salah!');
        }
    }

    public function register()
    {
        return view('/auth/register');
    }

    public function createUser(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('email', $request->email);
        Session::flash('nohp', $request->nohp);

        $request->validate([
            'nama'=>['required','regex:/^[A-Za-z\s]*$/','string','max:255'],
            'email'=>['required','regex:/(gmail|googlemail).com/','email','unique:users','max:255'],
            'nohp'=> ['required','regex:/^(\+62|62|0)8[1-9][0-9]{6,10}$/','string','min:9','max:14','unique:users'],
            'password'=> 'required|min:6|max:32',
            'g-recaptcha-response' => 'required|captcha'
        ],[
            'nama.required'=>'Harap isi nama terlebih dahulu!',
            'nama.max'=>'Nama Terlalu Panjang.',
            'nama.regex'=>'Nama Harus Huruf.',
            'email.required'=>'Harap isi email terlebih dahulu!',
            'email.email'=>'Email tidak valid :(',
            'email.max'=>'Email Terlalu Panjang :(',
            'email.unique'=>'Email udah pernah terdaftar :(',
            'email.regex'=>'Mohon maaf saat ini user hanya boleh menggunakan domain @gmail.com saja!',
            'nohp.required'=>'Harap isi No.HP terlebih dahulu :)',
            'nohp.unique'=>'No.HP sudah pernah terdaftar sebelumnya!',
            'nohp.min'=>'No. HP tidak valid! [Minimal 10 Angka]',
            'nohp.regex'=>'No. HP tidak valid! [Contoh : 0878xxxxxxxx [Min 10 Angka, Max 13 Angka]',
            'nohp.numeric'=>'No. HP harus angka!',
            'password.required'=>'Harap untuk mengisi password terlebih dahulu!',
            'password.min'=>'Minimum password 6 karakter!',
            'password.max'=>'Password terlalu panjang [MAX : 32]',
            'g-recaptcha-response.required'=>'Harap selesaikan captcha terlebih dahulu!'
        ]);

        if(preg_match('/[.+](?=[^\s@]*@gmail\.com)/', $request->email)) {
            return redirect('auth/register')->withErrors('Mohon maaf email yang anda masukkan tidak valid :( [dot trick prevent]');
        }

        $dataRegister = [
            'nama' => $request->nama,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'password' => Hash::Make($request->password),
            'tgl_pembuatan' => Carbon::now(),
            'apikey' => Str::random(32),
            'last_activity' => now()->getTimestamp(),
        ];

        User::create($dataRegister);

        $infoRegister = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infoRegister)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Berhasil Daftar Dan Login✔');
        } else {
            return redirect('auth')->withErrors('Email atau Password salah!');
        }
    }

    public function logout()
    {
        auth()->logout();
        Session()->flush();
        return redirect('/auth')->with('success', 'Berhasil Logout✔');
    }
}
