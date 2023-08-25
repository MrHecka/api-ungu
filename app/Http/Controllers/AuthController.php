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
    function index() {
        return view("auth/login");
    }

    function loginGan(Request $request) {;
        Session::flash('email',$request->email);

        $request->validate([
            'email'=>'required',
            'password'=> 'required'
        ],[
            'email.required'=>'Email nya diisi dulu oyy😡',
            'password.required'=>'Password nya diisi dulu oyy😡',
        ]);

        $dataLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($dataLogin)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success','Berhasil Login✔');
        } else {
            return redirect('auth')->withErrors('Email atau Password salah!');
        }
    }

    function register() {
        return view('/auth/register');
    }

    function createUser(Request $request) {
        Session::flash('nama',$request->nama);
        Session::flash('email',$request->email);
        Session::flash('nohp',$request->nohp);

        $request->validate([
            'nama'=>'required',
            'email'=>'required|email|unique:users',
            'nohp'=> 'required|unique:users|max:13',
            'password'=> 'required|min:6',
        ],[
            'nama.required'=>'Nama nya diisi dulu oyy😡',
            'email.required'=>'Email nya diisi dulu oyy😡',
            'email.email'=>'Email tidak valid woyyyy😡',
            'email.unique'=>'Email udah pernah terdaftar woyyy jan menuhin DB😡',
            'nohp.required'=>'No. HP nya diisi dulu oyy😡',
            'password.required'=>'Password nya diisi dulu oyy😡',
            'password.min'=>'Minimum password 6 karakter ngabb😡',
        ]);

        $dataRegister = [
            'nama'=>$request->nama,
            'email'=>$request->email,
            'nohp'=>$request->nohp,
            'password'=>Hash::Make($request->password),
            'tgl_pembuatan'=>Carbon::now(),
            'apikey'=>Str::random(32),
        ];

        User::create($dataRegister);

        $infoRegister = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infoRegister)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success','Berhasil Daftar Dan Login✔');
        } else {
            return redirect('auth')->withErrors('Email atau Password salah!');
        }
    }

    function logout() {
        Auth::logout();
        return redirect('/auth')->with('success','Berhasil Logout✔');
    }

}


