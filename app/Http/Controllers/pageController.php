<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pageController extends Controller
{
    function dashboard() {
        return view('/page/dashboard');
    }
}

