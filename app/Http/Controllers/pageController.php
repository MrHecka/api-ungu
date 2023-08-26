<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pageController extends Controller
{
    public function dashboard() {
        $usernameAuth = Auth::user()->nama;
        return view('/page/dashboard')->with(['userName'=>$usernameAuth]);
    }

    public function docs() {
        return view('/page/dashboard');
    }

    public function profil() {
        return view('/page/dashboard');
    }


}

