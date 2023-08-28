<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class pageController extends Controller
{
    public function dashboard()
    {
        $usernameAuth = Auth::user()->nama;
        return view('/page/dashboard')->with(['userName' => $usernameAuth]);
    }

    public function docs()
    {
        return view('/page/dashboard');
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

    public function edit()
    {
        // Retrieve user data for editing
        $user = auth()->user(); // Assuming you're using authentication

        // Pass the user data to the view for rendering
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nohp' => 'required|string|max:12|unique:users',
            'email' => 'required|string|email|max:255',
            'g-recaptcha-response' => 'required|captcha',
            'apikey' => 'required|min:32|max:32|unique:users|string'
            // Add more validation rules as needed
        ], [
            'nama.required' => 'Nama nya diisi dulu oyy😡',
            'email.required' => 'Email nya diisi dulu oyy😡',
            'email.email' => 'Email tidak valid woyyyy😡',
            'email.unique' => 'Email udah pernah terdaftar woyyy jan menuhin DB😡',
            'nohp.required' => 'No. HP nya diisi dulu oyy😡',
            'nohp.unique' => 'No. HP udah pernah terdaftar woyyy jan menuhin DB😡',
            'g-recaptcha-response.required' => 'Isi captcha dulu woyy dasar bot😡'
        ]);

        // Update the user's profile data
        $user = auth()->user(); // Assuming you're using authentication
        $user->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('profil')->with('success', 'Profile updated successfully.');
    }
}
